<?php
namespace App\Database\Seeds;

use App\Models\EntradaModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class TarjetaSeed extends Seeder
{
    public function run()
    {
        // Cargar el generador de Faker
        $faker = Factory::create();
        $entradaModel = model('EntradaModel'); // Traemos los valores de la tabla entrada con el modelo entrada
        $tarjetaModel = model('TarjetaModel'); // Traemos los valores de la tabla tarjeta con el modelo tarjeta

        // Obtener solo las entradas donde el tipo sea "Tarjeta"
        $tarjetas = $entradaModel->where('tipo', 'Tarjeta')->findAll(); // Filtramos las entradas por tipo "Tarjeta"
        $totalTarjetas = $entradaModel->where('tipo', 'Tarjeta')->countAllResults();

        if (empty($tarjetas)) {
            echo "No hay entradas de tipo 'Tarjeta' disponibles para insertar datos ficticios.";
            return;
        }

        // Obtener los IDs de las entradas y asegurarnos de que sean únicos
        $idsTarjetas = array_column($tarjetas, 'entrada_id');

        // Insertamos múltiples registros de datos ficticios
        for ($i = 0; $i < $totalTarjetas && !empty($idsTarjetas); $i++) {
            // Seleccionar un ID aleatorio y eliminarlo del array
            $selectedId = $faker->randomElement($idsTarjetas);
            $idsTarjetas = array_diff($idsTarjetas, [$selectedId]);

            // Insertar datos ficticios en la tabla tarjeta
            $tarjetaModel->insert([
                'entrada_id' => $selectedId, // ID único de entrada
                'nombre_tarjeta' => $faker->name,
                'marca' => $faker->creditCardType,
                'numero' => $faker->creditCardNumber,
                'exp_fecha' => $faker->creditCardExpirationDateString,
                'cvv' => $faker->numberBetween(100, 999),
                'notas' => $faker->optional()->text(200),
                'pregunta_clave' => $faker->boolean,
                'fecha_creacion' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'fecha_modificacion' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
