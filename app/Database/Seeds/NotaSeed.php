<?php
namespace App\Database\Seeds;

use App\Models\EntradaModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class NotaSeed extends Seeder
{
    public function run()
    {
        // Cargar el generador de Faker
        $faker = Factory::create();
        $entradaModel = model('EntradaModel'); // Traemos los valores de la tabla entrada con el modelo entrada
        $notaModel = model('NotaModel');       // Traemos los valores de la tabla nota con el modelo nota

        // Obtener solo las entradas donde el tipo sea "Nota"
        $entradasNota = $entradaModel->where('tipo', 'Nota')->findAll(); // Ordenadas por entrada_id
        $totalNotas = $entradaModel->where('tipo', 'Nota')->countAllResults();

        if (empty($entradasNota)) {
            echo "No hay entradas de tipo 'Nota' disponibles para insertar datos ficticios.";
            return;
        }

        // Obtener los IDs de las entradas de tipo "Nota"
        $idsEntradasNota = array_column($entradasNota, 'entrada_id');

        // Insertamos múltiples registros de datos ficticios
        for ($i = 0; $i < $totalNotas && !empty($idsEntradasNota); $i++) {
            // Seleccionar un ID aleatorio y eliminarlo de la lista
            $selectedId = $faker->randomElement($idsEntradasNota);
            $idsEntradasNota = array_diff($idsEntradasNota, [$selectedId]);

            // Insertar datos ficticios en la tabla nota
            $notaModel->insert([
                'entrada_id' => $selectedId, // ID único de entrada
                'contenido' => $faker->sentence(20), // Generar una oración con 20 palabras
                'pregunta_clave' => $faker->boolean(), // Verdadero o falso
                'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'), // Fecha de creación
                'updated_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'), // Fecha de actualización
            ]);
        }
    }
}


