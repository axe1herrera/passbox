<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EntradaModel;
use App\Models\IdentidadModel;
use App\Models\LoginModel;
use App\Models\NotaModel;
use App\Models\RegistroModel;
use App\Models\TarjetaModel;
use App\Models\UsuarioModel;
use App\Models\VaultModel;

class DataController extends ResourceController
{
    public function getAllData()
    {
        // Inicializar modelos
        $entradaModel = new EntradaModel();
        $identidadModel = new IdentidadModel();
        $loginModel = new LoginModel();
        $notaModel = new NotaModel();
        $registroModel = new RegistroModel();
        $tarjetaModel = new TarjetaModel();
        $usuarioModel = new UsuarioModel();
        $vaultModel = new VaultModel();

        // Obtener todos los datos de cada modelo
        $data = [
            'entradas' => $entradaModel->findAll(),
            'identidades' => $identidadModel->findAll(),
            'logins' => $loginModel->findAll(),
            'notas' => $notaModel->findAll(),
            'registros' => $registroModel->findAll(),
            'tarjetas' => $tarjetaModel->findAll(),
            'usuarios' => $usuarioModel->findAll(),
            'vaults' => $vaultModel->findAll()
        ];

        // Devolver todos los datos en formato JSON
        return $this->response->setJSON($data);
    }
}
