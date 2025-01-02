<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\VaultModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function register()
    {
        // Cargar vista de registro
        return view('auth/register');
    }

    public function registerUser()
    {
        // Instanciar modelos
        $usuarioModel = new UsuarioModel();
        $vaultModel = new VaultModel();

        // Obtener datos del formulario
        $nombre = $this->request->getPost('nombre');
        $correo = $this->request->getPost('correo');
        $clave_maestra = $this->request->getPost('clave_maestra');
        $clave_confirmacion = $this->request->getPost('clave_confirmacion');
        $pista_clave = $this->request->getPost('pista_clave');

        // Validar que las contraseñas coincidan
        if ($clave_maestra !== $clave_confirmacion) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden.');
        }

        // Validar si el correo ya está registrado
        if ($usuarioModel->where('correo', $correo)->first()) {
            return redirect()->back()->with('error', 'El correo ya está registrado. Usa otro.');
        }

        // Hashear la contraseña
        $clave_maestra_hashed = password_hash($clave_maestra, PASSWORD_BCRYPT);

        // Preparar datos del usuario
        $usuarioData = [
            'nombre' => $nombre,
            'correo' => $correo,
            'clave_maestra' => $clave_maestra_hashed,
            'pista_clave' => $pista_clave,
        ];

        // Intentar guardar el usuario
        $usuario_id = $usuarioModel->insert($usuarioData, true); // El segundo parámetro devuelve el ID insertado

        if ($usuario_id) {
            // Crear la caja fuerte "Mi caja fuerte"
            $vaultModel->insert([
                'usuario_id' => $usuario_id,
                'nombre' => 'Mi caja fuerte',
            ]);

            return redirect()->to('/auth/login')->with('success', 'Cuenta creada exitosamente. Por favor, inicia sesión.');
        } else {
            return redirect()->back()->with('error', 'Hubo un error al crear la cuenta.');
        }
    }


    public function login()
    {
        // Cargar vista de login
        return view('auth/login');
    }

    public function loginUser()
    {
        $usuarioModel = new UsuarioModel();

        $correo = $this->request->getPost('correo');
        $clave_maestra = $this->request->getPost('clave_maestra');

        // Buscar usuario por correo
        $usuario = $usuarioModel->where('correo', $correo)->first();

        if ($usuario && password_verify($clave_maestra, $usuario['clave_maestra'])) {
            // Crear sesión
            session()->set([
                'usuario_id' => $usuario['usuario_id'],
                'nombre' => $usuario['nombre'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/home');
        } else {
            return redirect()->back()->with('error', 'Correo o clave maestra incorrectos.');
        }
    }

    public function logout()
    {
        // Destruir sesión
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}

