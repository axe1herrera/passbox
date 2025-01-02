<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class VaultController extends Controller
{


    // Método que maneja la selección de la caja
    public function selectVault($vaultId)
    {
        // Almacena el vaultId en la sesión del servidor
            session()->set('selectedVaultId', $vaultId);

        // Redirige al usuario a la página de entradas o a donde desees
        return redirect()->to('/home'); // Cambia esto por la ruta que necesitas
    }
}

