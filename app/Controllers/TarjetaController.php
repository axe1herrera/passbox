<?php

namespace App\Controllers;

use App\Models\EntradaModel;
use App\Models\TarjetaModel;
use App\Models\VaultModel;
use App\Models\RegistroModel;
use App\Models\UsuarioModel;

class TarjetaController extends BaseController
{
    public function create()
    {
        $vaultModel = new VaultModel();
        $usuarioId = session()->get('usuario_id');

        if (!$usuarioId) {
            return redirect()->to('/auth/login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        $vaults = $vaultModel->where('usuario_id', $usuarioId)->findAll();

        $data = [
            'titulo' => 'Nueva Tarjeta',
            'vaults' => $vaults,
        ];

        return view('templates/header', $data)
            . view('tarjeta_form', $data)
            . view('templates/footer');
    }

    public function submit()
    {
        $entradaModel = new EntradaModel();
        $tarjetaModel = new TarjetaModel();
        $registroModel = new RegistroModel();

        $usuarioId = session()->get('usuario_id');

        if (!$usuarioId) {
            return redirect()->to('/auth/login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        // Validación
        $validation = $this->validate([
            'nombre' => ['label' => 'Nombre de la Entrada', 'rules' => 'required|max_length[100]'],
            'nombre_tarjeta' => ['label' => 'Nombre en la Tarjeta', 'rules' => 'required|max_length[100]'],
            'marca' => ['label' => 'Marca', 'rules' => 'required|max_length[50]'],
            'numero' => ['label' => 'Número de Tarjeta', 'rules' => 'required|numeric|max_length[20]'],
            'exp_fecha' => ['label' => 'Fecha de Expiración', 'rules' => 'required|valid_date'],
            'cvv' => ['label' => 'CVV', 'rules' => 'required|numeric|max_length[4]'],
            'notas' => ['label' => 'Notas', 'rules' => 'max_length[500]'],
            'pregunta_clave' => ['label' => 'Pregunta Clave', 'rules' => 'required|in_list[0,1]'],
            'vault_id' => ['label' => 'Caja Fuerte', 'rules' => 'required|is_not_unique[caja_fuerte.vault_id]'],
        ]);

        if (!$validation) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        // Crear la entrada principal
        $entradaData = [
            'nombre' => $this->request->getPost('nombre'),
            'tipo' => 'Tarjeta',
        ];

        $entradaId = $entradaModel->insert($entradaData, true);

        // Crear el registro de la tarjeta
        $tarjetaData = [
            'entrada_id' => $entradaId,
            'nombre_tarjeta' => $this->request->getPost('nombre_tarjeta'),
            'marca' => $this->request->getPost('marca'),
            'numero' => $this->request->getPost('numero'),
            'exp_fecha' => $this->request->getPost('exp_fecha'),
            'cvv' => $this->request->getPost('cvv'),
            'notas' => $this->request->getPost('notas'),
            'pregunta_clave' => $this->request->getPost('pregunta_clave'),
        ];

        $tarjetaModel->insert($tarjetaData);

        // Crear el registro para vincular la entrada con la caja fuerte seleccionada
        $registroData = [
            'vault_id' => $this->request->getPost('vault_id'),
            'entrada_id' => $entradaId,
        ];

        $registroModel->insert($registroData);

        session()->setFlashdata('success', 'La tarjeta se guardó exitosamente.');

        return redirect()->to('/tarjeta/create');
    }

    public function cargar($entradaId)
    {
        $entradaModel = new EntradaModel();
        $tarjetaModel = new TarjetaModel();
        $registroModel = new RegistroModel();
        $vaultModel = new VaultModel();

        // Obtener entrada
        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Identidad no encontrada.');
        }

        // Obtener la entrada asociada a la identidad
        $tarjeta = $tarjetaModel->where('entrada_id', $entradaId)->first();
        if (!$tarjeta) {
            $tarjeta = [
                'nombre_tarjeta' => '',
                'marca' => '',
                'numero' => '',
                'exp_fecha' => '',
                'cvv' => '',
                'notas' => '',
                'pregunta_clave' => false,  // Valor por defecto para la pregunta clave
            ];
        }

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
            'titulo' => 'Editar tarjeta',
            'entrada' => $entrada,
            'tarjeta' => $tarjeta,
            'vaults' => $vaults,
            'vaultId' => $vaultId, // Pasamos el vault_id a la vista
        ];

        return view('templates/header', $data)
            . view('tarjeta_editar', $data)
            . view('templates/footer');
    }


    public function guardar($entradaId)
    {
        $entradaModel = new EntradaModel();
        $tarjetaModel = new TarjetaModel();
        $registroModel = new RegistroModel();

        // Validar los datos del formulario
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nombre' => 'required|max_length[100]',
            'nombre_tarjeta' =>'required|max_length[100]',
            'marca' => 'required|max_length[50]',
            'numero' => 'required|numeric|max_length[20]',
            'exp_fecha' => 'required|valid_date',
            'cvv' => 'required|numeric|max_length[4]',
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

        // Actualizar la identidad
        $tarjetaData = [

            'nombre_tarjeta' => $this->request->getPost('nombre_tarjeta'),
            'marca' => $this->request->getPost('marca'),
            'numero' => $this->request->getPost('numero'),
            'exp_fecha' => $this->request->getPost('exp_fecha'),
            'cvv' => $this->request->getPost('cvv'),
            'notas' => $this->request->getPost('notas'),
            'pregunta_clave' => $this->request->getPost('pregunta_clave'),
        ];
        $tarjeta = $tarjetaModel->where('entrada_id', $entradaId)->first();

        if ($tarjeta) {
            // Si ya existe la identidad, actualizarla
            $tarjetaModel->update($tarjeta['tarjeta_id'], $tarjetaData);
        } else {
            // Si no existe la identidad, crearla
            $tarjetaData['entrada_id'] = $entradaId;
            $tarjetaModel->insert($tarjetaData);
        }

        return redirect()->to('/tarjeta/cargar/' . $entradaId)->with('success', 'Nota actualizada con éxito.');
    }

    public function eliminar($entradaId)
    {
        $tarjetaModel = new TarjetaModel();
        $entradaModel = new EntradaModel();

        // Obtener la identidad
        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Entrada no encontrada.');
        }
        // Buscar la nota asociada a la entrada
        $tarjeta = $tarjetaModel->where('entrada_id', $entradaId)->first();
        if ($tarjeta) {
            // Eliminar la nota
            $tarjetaModel->delete($tarjeta['tarjeta_id']);
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

    public function mostrarModal()
    {

    }

}

