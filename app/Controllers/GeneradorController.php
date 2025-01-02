<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class GeneradorController extends Controller
{
    // Método que carga la vista para crear una contraseña
    public function index()
    {
        // Mostrar la vista de generar contraseña
        return view('templates/header') . view('generate_password') . view('templates/footer');
    }

    // Método para crear la contraseña
    public function createPassword()
    {
        // Obtener los parámetros del formulario
        $length = $this->request->getPost('length');
        $min_numbers = $this->request->getPost('min_numbers');
        $min_special_chars = $this->request->getPost('min_special_chars');
        $options = $this->request->getPost('options');

        // Generar la contraseña
        $password = $this->generatePassword($length, $min_numbers, $min_special_chars, $options);

        // Pasar la contraseña generada a la vista sin cambiar de página
        return view('templates/header')
            . view('generate_password', ['password' => $password])
            . view('templates/footer');
    }

    // Lógica para generar la contraseña
    private function generatePassword($length, $min_numbers, $min_special_chars, $options)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $special_chars = '!@$!%*?&';
        $numbers = '0123456789';

        // Agregar opciones seleccionadas
        if (in_array('a-z', $options)) $characters .= 'abcdefghijklmnopqrstuvwxyz';
        if (in_array('A-Z', $options)) $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if (in_array('0-9', $options)) $characters .= '0123456789';
        if (in_array('!@#%&', $options)) $characters .= '@$!%*?&';

        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $password;
    }
}

