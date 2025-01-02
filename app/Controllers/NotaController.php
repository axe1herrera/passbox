<?php

namespace App\Controllers;

use App\Models\EntradaModel;
use App\Models\NotaModel;
use App\Models\VaultModel;
use App\Models\RegistroModel;
use App\Models\UsuarioModel;

class NotaController extends BaseController
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
            'titulo' => 'Nueva Nota',
            'vaults' => $vaults,
        ];

        return view('templates/header', $data)
            . view('nota_form', $data)
            . view('templates/footer');
    }

    public function submit()
    {
        $entradaModel = new EntradaModel();
        $notaModel = new NotaModel();
        $registroModel = new RegistroModel();

        $usuarioId = session()->get('usuario_id');

        if (!$usuarioId) {
            return redirect()->to('/auth/login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        // Validación
        $validation = $this->validate([
            'nombre' => ['label' => 'Nombre de la entrada', 'rules' => 'required|max_length[100]'],
            'contenido' => ['label' => 'Contenido', 'rules' => 'required'],
            'pregunta_clave' => ['label' => 'Pregunta Clave', 'rules' => 'required|in_list[0,1]'],
            'vault_id' => ['label' => 'Caja Fuerte', 'rules' => 'required|is_not_unique[caja_fuerte.vault_id]'],
        ]);

        if (!$validation) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        // Crear la entrada
        $entradaData = [
            'nombre' => $this->request->getPost('nombre'),
            'tipo' => 'Nota',
        ];

        $entradaId = $entradaModel->insert($entradaData, true);

        // Crear el registro de la nota
        $notaData = [
            'entrada_id' => $entradaId,
            'contenido' => $this->request->getPost('contenido'),
            'pregunta_clave' => $this->request->getPost('pregunta_clave'),
        ];

        $notaModel->insert($notaData);

        // Registrar la relación con la caja fuerte
        $registroModel->insert([
            'vault_id' => $this->request->getPost('vault_id'),
            'entrada_id' => $entradaId
        ]);

        session()->setFlashdata('success', 'La nota se guardó exitosamente.');

        return redirect()->to('/nota/create');
    }

    public function cargar($entradaId)
    {
        $entradaModel = new EntradaModel();
        $notaModel = new NotaModel();
        $vaultModel = new VaultModel();
        $registroModel = new RegistroModel();

        // Obtener la entrada
        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Entrada no encontrada.');
        }

        // Obtener la nota asociada
        $nota = $notaModel->where('entrada_id', $entradaId)->first();
        if (!$nota) {
            $nota = ['contenido' => '', 'pregunta_clave' => false];
        }

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
            'titulo' => 'Editar Nota',
            'entrada' => $entrada,
            'nota' => $nota,
            'vaults' => $vaults,
            'vaultId' => $vaultId, // Pasamos el vault_id a la vista
        ];

        return view('templates/header', $data)
            . view('nota_editar', $data)
            . view('templates/footer');
    }

    public function guardar($entradaId)
    {
        $entradaModel = new EntradaModel();
        $notaModel = new NotaModel();
        $registroModel = new RegistroModel();

        // Validar los datos del formulario
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nombre' => 'required|string|max_length[100]',
            'contenido' => 'required|string',
            'pregunta_clave' => 'required|in_list[0,1]',
            'vault_id' => 'required|is_natural_no_zero', // Validar el vault_id
        ])) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Obtener la entrada
        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Entrada no encontrada.');
        }

        // Actualizar la entrada
        $entradaData = [
            'nombre' => $this->request->getPost('nombre'),
        ];
        $entradaModel->update($entradaId, $entradaData);

        // Actualizar la caja fuerte asociada en la tabla Registro
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

        // Obtener o crear la nota asociada a la entrada
        $notaData = [
            'contenido' => $this->request->getPost('contenido'),
            'pregunta_clave' => $this->request->getPost('pregunta_clave'),
        ];

        $nota = $notaModel->where('entrada_id', $entradaId)->first();
        if ($nota) {
            // Si ya existe la nota, actualizarla
            $notaModel->update($nota['nota_id'], $notaData);
        } else {
            // Si no existe la nota, crearla
            $notaData['entrada_id'] = $entradaId;
            $notaModel->insert($notaData);
        }

        return redirect()->to('/nota/cargar/' . $entradaId)->with('success', 'Nota actualizada con éxito.');
    }



    public function eliminar($entradaId)
    {
        $entradaModel = new EntradaModel();
        $notaModel = new NotaModel();

        // Buscar la entrada
        $entrada = $entradaModel->getEntrada($entradaId);
        if (!$entrada) {
            return redirect()->to('/entradas')->with('error', 'Entrada no encontrada.');
        }

        // Buscar la nota asociada a la entrada
        $nota = $notaModel->where('entrada_id', $entradaId)->first();
        if ($nota) {
            // Eliminar la nota
            $notaModel->delete($nota['nota_id']);
        }

        // Eliminar la entrada
        $entradaModel->delete($entradaId);

        return redirect()->to('/home')->with('success', 'Nota y entrada eliminadas con éxito.');
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




