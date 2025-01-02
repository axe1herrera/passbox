<?php
namespace App\Controllers;

use App\Models\EntradaModel;
use App\Models\RegistroModel;
use CodeIgniter\Controller;

class BuscarController extends Controller
{
    public function buscar()
    {
        // Inicializamos la variable $data para pasarla a la vista
        $data = [];

        // Obtener el valor del campo 'query' enviado por el formulario
        $query = $this->request->getGet('query');

        // Obtener el vault_id seleccionado de la sesión
        $selectedVaultId = session()->get('selectedVaultId');

        // Si no hay vault_id activo, retornar un mensaje de error
        if (!$selectedVaultId) {
            $data['mensaje'] = 'No hay una caja fuerte seleccionada en la sesión.';
            return view('templates/header').
                view('home2', $data)
            .view('templates/footer'); // Redirige a la vista home2
        }

        // Cargar el modelo de Registro y Entrada
        $registroModel = new RegistroModel();
        $entradaModel = new EntradaModel();

        // Obtener los registros (entradas asociadas al vault_id seleccionado)
        $registros = $registroModel->where('vault_id', $selectedVaultId)->findAll();

        // Filtrar las entradas asociadas a esos registros
        $resultados = [];
        foreach ($registros as $registro) {
            // Obtener la entrada asociada
            $entrada = $entradaModel->find($registro['entrada_id']);

            // Comprobar si el nombre de la entrada coincide con el término de búsqueda
            if (stripos($entrada['nombre'], $query) !== false) {
                // Si hay coincidencia, agregar la entrada a los resultados
                $resultados[] = $entrada;
            }
        }

        // Pasar los resultados a la vista home2
        if (!empty($resultados)) {
            $data['resultados'] = $resultados;
        } else {
            $data['mensaje'] = 'No se encontró ninguna entrada con el nombre: ' . esc($query);
        }

        // Redirige a la vista home2
        return view('templates/header').
            view('home2', $data)
            .view('templates/footer');
    }
}





