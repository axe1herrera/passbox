<?php

namespace App\Controllers;

use App\Models\EntradaModel;
use App\Models\IdentidadModel;
use App\Models\UsuarioModel;
use App\Models\VaultModel;
use App\Models\RegistroModel;

class IdentidadController extends BaseController
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
            'titulo' => 'Nueva Identidad',
            'vaults' => $vaults,
        ];

        return view('templates/header', $data)
            . view('identidad_form', $data)
            . view('templates/footer');
    }

    public function submit()
    {
        $entradaModel = new EntradaModel();
        $identidadModel = new IdentidadModel();
        $registroModel = new RegistroModel();

        $usuarioId = session()->get('usuario_id');

        if (!$usuarioId) {
            return redirect()->to('/auth/login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        // Validación de campos
        $validation = $this->validate([
            'nombre' => ['label' => 'Nombre de la entrada', 'rules' => 'required|max_length[100]'],
            'titulo' => ['label' => 'Título', 'rules' => 'max_length[50]'],
            'primer_nombre' => ['label' => 'Primer nombre', 'rules' => 'required|max_length[100]'],
            'segundo_nombre' => ['label' => 'Segundo nombre', 'rules' => 'max_length[100]'],
            'apellidos' => ['label' => 'Apellidos', 'rules' => 'required|max_length[100]'],
            'empresa' => ['label' => 'Empresa', 'rules' => 'max_length[100]'],
            'nss' => ['label' => 'NSS', 'rules' => 'max_length[11]'],
            'pasaporte' => ['label' => 'Pasaporte', 'rules' => 'max_length[9]'],
            'licencia' => ['label' => 'Licencia', 'rules' => 'max_length[14]'],
            'email' => ['label' => 'Email', 'rules' => 'valid_email|max_length[100]'],
            'telefono' => ['label' => 'Teléfono', 'rules' => 'numeric|max_length[10]'],
            'direccion_1' => ['label' => 'Dirección 1', 'rules' => 'max_length[255]'],
            'direccion_2' => ['label' => 'Dirección 2', 'rules' => 'max_length[255]'],
            'ciudad_pueblo' => ['label' => 'Ciudad/Pueblo', 'rules' => 'max_length[100]'],
            'estado' => ['label' => 'Estado', 'rules' => 'max_length[100]'],
            'codigo_postal' => ['label' => 'Código Postal', 'rules' => 'numeric|max_length[5]'],
            'pais' => ['label' => 'País', 'rules' => 'max_length[100]'],
            'notas' => ['label' => 'Notas', 'rules' => 'max_length[500]'],
            'pregunta_clave' => ['label' => 'Pregunta Clave', 'rules' => 'required|in_list[0,1]'],
            'vault_id' => ['label' => 'Caja Fuerte', 'rules' => 'required|is_not_unique[caja_fuerte.vault_id]'],
        ]);

        if (!$validation) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        // Crear la entrada
        $entradaData = [
            'nombre' => $this->request->getPost('nombre'),
            'tipo' => 'Identidad',
        ];

        $entradaId = $entradaModel->insert($entradaData, true);

        // Crear el registro de la identidad
        $identidadData = [
            'entrada_id' => $entradaId,
            'titulo' => $this->request->getPost('titulo'),
            'primer_nombre' => $this->request->getPost('primer_nombre'),
            'segundo_nombre' => $this->request->getPost('segundo_nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'empresa' => $this->request->getPost('empresa'),
            'nss' => $this->request->getPost('nss'),
            'pasaporte' => $this->request->getPost('pasaporte'),
            'licencia' => $this->request->getPost('licencia'),
            'email' => $this->request->getPost('email'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion_1' => $this->request->getPost('direccion_1'),
            'direccion_2' => $this->request->getPost('direccion_2'),
            'ciudad_pueblo' => $this->request->getPost('ciudad_pueblo'),
            'estado' => $this->request->getPost('estado'),
            'codigo_postal' => $this->request->getPost('codigo_postal'),
            'pais' => $this->request->getPost('pais'),
            'notas' => $this->request->getPost('notas'),
            'pregunta_clave' => $this->request->getPost('pregunta_clave'),
        ];

        $identidadModel->insert($identidadData);

        // Registrar la relación con la caja fuerte
        $registroModel->insert([
            'vault_id' => $this->request->getPost('vault_id'),
            'entrada_id' => $entradaId
        ]);

        session()->setFlashdata('success', 'La identidad se guardó exitosamente.');

        return redirect()->to('/identidad/create');
    }

    public function cargar($entradaId)
    {
        $entradaModel = new EntradaModel();
        $identidadModel = new IdentidadModel();
        $registroModel = new RegistroModel();
        $vaultModel = new VaultModel();

        // Obtener entrada
        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Identidad no encontrada.');
        }

        // Obtener la entrada asociada a la identidad
        $identidad = $identidadModel->where('entrada_id', $entradaId)->first();
        if (!$identidad) {
            $identidad = [
                'titulo' => '',
                'primer_nombre' => '',
                'segundo_nombre' => '',
                'apellidos' => '',
                'empresa' => '',
                'nss' => '',
                'pasaporte' => '',
                'licencia' => '',
                'email' => '',
                'telefono' => '',
                'direccion_1' => '',
                'direccion_2' => '',
                'ciudad_pueblo' => '',
                'estado' => '',
                'codigo_postal' => '',
                'pais' => '',
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
            'titulo' => 'Editar Identidad',
            'entrada' => $entrada,
            'identidad' => $identidad,
            'vaults' => $vaults,
            'vaultId' => $vaultId, // Pasamos el vault_id a la vista
        ];

        return view('templates/header', $data)
            . view('identidad_editar', $data)
            . view('templates/footer');
    }

    public function guardar($entradaId)
    {
        $entradaModel = new EntradaModel();
        $identidadModel = new IdentidadModel();
        $registroModel = new RegistroModel();

        // Validar los datos del formulario
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nombre' => 'required|max_length[100]',
            'titulo' => 'max_length[50]',
            'primer_nombre' => 'required|max_length[100]',
            'segundo_nombre' => 'max_length[100]',
            'apellidos' => 'required|max_length[100]',
            'empresa' => 'max_length[100]',
            'nss' => 'max_length[11]',
            'pasaporte' =>'max_length[9]',
            'licencia' => 'max_length[14]',
            'email' => 'valid_email|max_length[100]',
            'telefono' => 'numeric|max_length[10]',
            'direccion_1' => 'max_length[255]',
            'direccion_2' => 'max_length[255]',
            'ciudad_pueblo' => 'max_length[100]',
            'estado' => 'max_length[100]',
            'codigo_postal' => 'numeric|max_length[5]',
            'pais' => 'max_length[100]',
            'notas' =>'max_length[500]',
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
        $identidadData = [
            'titulo' => $this->request->getPost('titulo'),
            'primer_nombre' => $this->request->getPost('primer_nombre'),
            'segundo_nombre' => $this->request->getPost('segundo_nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'empresa' => $this->request->getPost('empresa'),
            'nss' => $this->request->getPost('nss'),
            'pasaporte' => $this->request->getPost('pasaporte'),
            'licencia' => $this->request->getPost('licencia'),
            'email' => $this->request->getPost('email'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion_1' => $this->request->getPost('direccion_1'),
            'direccion_2' => $this->request->getPost('direccion_2'),
            'ciudad_pueblo' => $this->request->getPost('ciudad_pueblo'),
            'estado' => $this->request->getPost('estado'),
            'codigo_postal' => $this->request->getPost('codigo_postal'),
            'pais' => $this->request->getPost('pais'),
            'notas' => $this->request->getPost('notas'),
            'pregunta_clave' => $this->request->getPost('pregunta_clave'),
        ];
        $identidad = $identidadModel->where('entrada_id', $entradaId)->first();

        if ($identidad) {
            // Si ya existe la identidad, actualizarla
            $identidadModel->update($identidad['identidad_id'], $identidadData);
        } else {
            // Si no existe la identidad, crearla
            $identidadData['entrada_id'] = $entradaId;
            $identidadModel->insert($identidadData);
        }

        return redirect()->to('/identidad/cargar/' . $entradaId)->with('success', 'Nota actualizada con éxito.');
    }

    public function eliminar($entradaId)
    {
        $identidadModel = new IdentidadModel();
        $entradaModel = new EntradaModel();

        // Obtener la identidad
        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Entrada no encontrada.');
        }
        // Buscar la nota asociada a la entrada
        $identidad = $identidadModel->where('entrada_id', $entradaId)->first();
        if ($identidad) {
            // Eliminar la nota
            $identidadModel->delete($identidad['identidad_id']);
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

