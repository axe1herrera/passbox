<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\VaultModel;
use App\Models\EntradaModel;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'titulo' => 'Página de Inicio'
        ];
        return view('auth/login', $data);
    }


    public function dashboard()
    {
        $vaultModel = new VaultModel();
        $entradaModel = new EntradaModel();

        $usuario_id = session()->get('usuario_id'); // Obtén el ID del usuario desde la sesión.

        $userModel = new UsuarioModel();
        $usuario = $userModel->where('usuario_id', $usuario_id)->first(); // Obtener el usuario por ID
        $usuario_name = $usuario['nombre']; // Suponiendo que el campo del nombre es 'name'

        // Obtener todas las cajas fuertes del usuario
        $cajas_fuertes = $vaultModel->where('usuario_id', $usuario_id)->findAll();

        // Inicializar las entradas asociadas
        $entradas = [];
        foreach ($cajas_fuertes as $caja) {
            $entradas[$caja['vault_id']] = $entradaModel->join('registro', 'registro.entrada_id = entrada.entrada_id')
                ->where('registro.vault_id', $caja['vault_id'])
                ->findAll();
        }

        // Cargar la vista con los datos
        return
            view('templates/header', ['nombre_usuario' => $usuario_name])
            .view('home', [
            'cajas_fuertes' => $cajas_fuertes,
            'entradas' => $entradas,
        ])
            . view('templates/footer');

    }

    public function buscar()
    {
        $entradaModel = new EntradaModel();
        $query = $this->request->getGet('query');

        $usuario_id = session()->get('usuario_id');
        $resultados = $entradaModel
            ->select('entrada.*')
            ->join('registro', 'registro.entrada_id = entrada.entrada_id')
            ->join('caja_fuerte', 'caja_fuerte.vault_id = registro.vault_id')
            ->where('caja_fuerte.usuario_id', $usuario_id)
            ->like('entrada.nombre', $query)
            ->findAll();

        return view('templates/header')
            . view('home', ['resultados' => $resultados])
            . view('templates/footer');
    }

// HomeController.php o el controlador correspondiente
    public function crearCajaFuerte()
    {
        // Asegurarse de que el usuario está autenticado
        $session = session();
        if (!$session->has('usuario_id')) {
            return redirect()->to('/auth/login'); // Redirigir si no hay sesión activa
        }

        // Obtener el nombre de la caja fuerte desde el formulario
        $nombre = $this->request->getPost('nombre');
        $usuario_id = $session->get('usuario_id'); // ID del usuario autenticado

        // Validar que el nombre no esté vacío
        if (empty($nombre)) {
            return redirect()->back()->with('error', 'El nombre de la caja fuerte es obligatorio.');
        }

        // Guardar la nueva caja fuerte en la base de datos
        $vaultModel = new \App\Models\VaultModel();
        $data = [
            'usuario_id' => $usuario_id,
            'nombre' => $nombre
        ];
        $vaultModel->insert($data);

        // Verificar si la inserción fue exitosa
        if ($vaultModel->errors()) {
            // Si hubo errores, muestra el mensaje
            return redirect()->back()->with('error', 'Hubo un error al crear la caja fuerte.');
        }

        // Redirigir a la vista de cajas fuertes con mensaje de éxito
        return redirect()->to('/home')->with('success', 'Caja fuerte creada exitosamente.');
    }

    public function buscarCajaFuerte(){

            $vaultModel = new VaultModel();
            // Obtener las cajas fuertes del usuario
            $usuarioId = session()->get('usuario_id');
            $vaults = $vaultModel->where('usuario_id', $usuarioId)->findAll();

            // Verificar que los datos realmente se estén obteniendo
            if (empty($vaults)) {
                echo "No se encontraron cajas fuertes.";
            } else {
                echo "Cajas Fuertes encontradas.";
            }

            // Pasar los datos a la vista
            $data = ['vaults' => $vaults];
            return view('templates/header')
                . view('home', $data)
                . view('templates/footer');


    }




}
