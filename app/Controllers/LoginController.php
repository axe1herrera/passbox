<?php

namespace App\Controllers;

use App\Models\EntradaModel;
use App\Models\LoginModel;
use App\Models\UsuarioModel;
use App\Models\VaultModel;
use App\Models\RegistroModel;
class LoginController extends BaseController
{

    // Clave secreta para cifrar y descifrar (debe mantenerse segura)
    const ENCRYPTION_KEY = 'your-secret-encryption-key';

    // Cifrado de la contraseña
    private function encrypt_password($password)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));  // IV aleatorio
        $encrypted_password = openssl_encrypt($password, 'aes-256-cbc', self::ENCRYPTION_KEY, 0, $iv);
        return base64_encode($encrypted_password . '::' . $iv); // Guardamos el IV junto con la contraseña cifrada
    }


    // Descifrado de la contraseña
    private function decrypt_password($encrypted_password)
    {
        list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_password), 2); // Separar datos cifrados y IV
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', self::ENCRYPTION_KEY, 0, $iv);
    }




    public function create()
    {
        $vaultModel = new VaultModel();
        $usuarioId = session()->get('usuario_id');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        $vaults = $vaultModel->where('usuario_id', $usuarioId)->findAll();

        $data = [
            'titulo' => 'Nuevo login',
            'vaults' => $vaults,
        ];

        return view('templates/header', $data)
            . view('login_form', $data)
            . view('templates/footer');
    }


    public function submit()
    {
        $entradaModel = new EntradaModel();
        $loginModel = new LoginModel();
        $registroModel = new RegistroModel();

        $usuarioId = session()->get('usuario_id'); // Supongamos que el usuario autenticado está almacenado en la sesión.

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        $validation = $this->validate([
            'nombre' => ['label' => 'Nombre', 'rules' => 'required|max_length[100]'],
            'usuario' => ['label' => 'Usuario', 'rules' => 'required|max_length[20]'],
            'contrasenia' => [
                'label' => 'Contraseña',
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
            ],
            'url' => ['label' => 'URL', 'rules' => 'valid_url|max_length[255]'],
            'notas' => ['label' => 'Notas', 'rules' => 'max_length[500]'],
            'pregunta_clave' => ['label' => 'Pregunta Clave', 'rules' => 'required|in_list[0,1]'],
            'vault_id' => ['label' => 'Caja Fuerte', 'rules' => 'required|is_not_unique[caja_fuerte.vault_id]'],
        ]);

        if (!$validation) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $entradaData = [
            'nombre' => $this->request->getPost('nombre'),
            'tipo' => 'Login',
        ];

        $entradaId = $entradaModel->insert($entradaData, true);

        // Cifrar la contraseña antes de guardarla
        $password = $this->request->getPost('contrasenia');
        $encryptedPassword = $this->encrypt_password($password);  // Ciframos la contraseña

        $loginData = [
            'entrada_id' => $entradaId,
            'usuario' => $this->request->getPost('usuario'),
            'contrasenia' => $encryptedPassword,
            'url' => $this->request->getPost('url'),
            'notas' => $this->request->getPost('notas'),
            'pregunta_clave' => $this->request->getPost('pregunta_clave'),
        ];

        $loginModel->insert($loginData);

        // Crear un registro para vincular la entrada con la caja fuerte seleccionada.
        $registroData = [
            'vault_id' => $this->request->getPost('vault_id'),
            'entrada_id' => $entradaId,
        ];

        $registroModel->insert($registroData);

        session()->setFlashdata('success', 'El registro se guardó exitosamente.');

        return redirect()->to('/login/create');
    }


    public function cargar($entradaId)
    {
        $entradaModel = new EntradaModel();
        $loginModel = new LoginModel();
        $registroModel = new RegistroModel();
        $vaultModel = new VaultModel();

        // Obtener entrada
        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Login no encontrada.');
        }

        // Obtener la entrada asociada a la identidad
        $login = $loginModel->where('entrada_id', $entradaId)->first();
        if (!$login) {
            $login = [
                'usuario' => '',
                'contrasenia' => '',
                'url' => '',
                'notas' => '',
                'pregunta_clave' => false,
            ];
        }

        // Desencriptar la contraseña
        $login['contrasenia'] = $this->decrypt_password($login['contrasenia']);

        // Obtener el vault_id asociado a esta entrada desde la tabla Registro
        $registro = $registroModel->where('entrada_id', $entradaId)->first();
        if ($registro) {
            $vaultId = $registro['vault_id']; // El vault_id asociado
        } else {
            $vaultId = null; // Si no existe un registro, no hay caja fuerte asociada
        }

        // Obtener las cajas fuertes del usuario
        $usuarioId = session()->get('usuario_id');
        $vaults = $vaultModel->where('usuario_id', $usuarioId)->findAll();

        // Pasar los datos a la vista
        $data = [
            'titulo' => 'Editar Login',
            'entrada' => $entrada,
            'login' => $login,
            'vaults' => $vaults,
            'vaultId' => $vaultId, // Pasamos el vault_id a la vista
        ];

        return view('templates/header', $data)
            . view('login_editar', $data)
            . view('templates/footer');
    }


    public function guardar($entradaId)
    {
        $entradaModel = new EntradaModel();
        $loginModel = new LoginModel();
        $registroModel = new RegistroModel();

        // Validar los datos del formulario
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nombre' => 'required|max_length[100]',
            'usuario' =>'required|max_length[20]',
            'contrasenia' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
            'url' => 'valid_url|max_length[255]',
            'notas' => 'max_length[500]',
            'pregunta_clave' => 'required|in_list[0,1]',
            'vault_id' => 'required|is_not_unique[caja_fuerte.vault_id]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Entrada no encontrada.');
        }


        // Actualizar la entrada
        $entradaData = [
            'nombre' => $this->request->getPost('nombre'),
        ];
        $entradaModel->update($entradaId, $entradaData);

        $registroData = [
            'vault_id' => $this->request->getPost('vault_id'),
        ];
        $registro = $registroModel->where('entrada_id', $entradaId)->first();
        if ($registro) {
            $registroModel->update($registro['registro_id'], $registroData);
        } else {
            $registroData['entrada_id'] = $entradaId;
            $registroModel->insert($registroData);
        }

        $password = $this->request->getPost('contrasenia');
        $encryptedPassword = $this->encrypt_password($password);  // Ciframos la contraseña
        // Actualizar la login
        $loginData = [
            'usuario' => $this->request->getPost('usuario'),
            'contrasenia' => $encryptedPassword,
                //password_hash($this->request->getPost('contrasenia'), PASSWORD_DEFAULT),
            'url' => $this->request->getPost('url'),
            'notas' => $this->request->getPost('notas'),
            'pregunta_clave' => $this->request->getPost('pregunta_clave'),
        ];
        $login = $loginModel->where('entrada_id', $entradaId)->first();

        if ($login) {
            // Si ya existe la identidad, actualizarla
            $loginModel->update($login['login_id'], $loginData);
        } else {
            // Si no existe la identidad, crearla
            $loginData['entrada_id'] = $entradaId;
            $loginModel->insert($loginData);
        }

        return redirect()->to('/login/cargar/' . $entradaId)->with('success', 'Login actualizada con éxito.');
    }

    public function eliminar($entradaId)
    {
        $loginModel = new LoginModel();
        $entradaModel = new EntradaModel();

        // Obtener la identidad
        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Entrada no encontrada.');
        }
        // Buscar la nota asociada a la entrada
        $login = $loginModel->where('entrada_id', $entradaId)->first();
        if ($login) {
            // Eliminar la nota
            $loginModel->delete($login['login_id']);
        }
        $entradaModel->delete($entradaId);

        // Eliminar la identidad
        return redirect()->to('/home')->with('success', 'Identidad y entrada eliminadas con éxito.');
    }

    public function verificarContrasenia()
    {
        $usuarioModel = new UsuarioModel();
        $usuarioId = session()->get('usuario_id');

        // Obtenemos la contraseña desde la solicitud JSON
        $password = $this->request->getVar('password');

        if (!$usuarioId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Usuario no encontrado']);
        }

        $usuario = $usuarioModel->find($usuarioId);

        if (!$usuario) {
            return $this->response->setJSON(['success' => false, 'message' => 'Usuario no existe']);
        }

        // Verificamos que la contraseña se haya enviado correctamente
        if (empty($password)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Contraseña vacía']);
        }

        // Verificamos la contraseña con hash
        if (password_verify($password, $usuario['clave_maestra'])) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Contraseña incorrecta']);
        }
    }



}


