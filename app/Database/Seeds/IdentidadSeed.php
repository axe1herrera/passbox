<?php
namespace App\Database\Seeds;

use App\Models\EntradaModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class IdentidadSeed extends Seeder
{
    public function run()
    {
        // Cargar el generador de Faker
        $faker = Factory::create();
        $entradaModel = model('EntradaModel'); // Traemos los valores de la tabla entrada con el modelo entrada
        $identidadModel = model('IdentidadModel'); // Traemos los valores de la tabla identidad con el modelo identidad

        // Obtener solo las entradas donde el tipo sea "Identidad", ordenadas por entrada_id
        $identidades = $entradaModel->where('tipo', 'Identidad')->findAll();
        $totalIdentidades = $entradaModel->where('tipo', 'Identidad')->countAllResults();

        if (empty($identidades)) {
            echo "No hay entradas de tipo 'Identidad' disponibles para insertar datos ficticios.";
            return;
        }

        // Obtener los IDs de las entradas de tipo "Identidad"
        $idsIdentidades = array_column($identidades, 'entrada_id');

        // Insertamos múltiples registros de datos ficticios
        for ($i = 0; $i < $totalIdentidades && !empty($idsIdentidades); $i++) {
            // Seleccionar un ID aleatorio y eliminarlo de la lista
            $selectedId = $faker->randomElement($idsIdentidades);
            $idsIdentidades = array_diff($idsIdentidades, [$selectedId]);

            // Insertar datos ficticios en la tabla identidad
            $identidadModel->insert([
                'entrada_id'        => $selectedId, // ID único de entrada
                'titulo'            => $faker->title,
                'primer_nombre'     => $faker->firstName,
                'segundo_nombre'    => $faker->optional()->firstName, // Puede ser nulo
                'apellidos'         => $faker->lastName,
                'empresa'           => $faker->optional()->company,  // Puede ser nulo
                'nss'               => $faker->optional()->regexify('[0-9]{9}'), // Número ficticio
                'pasaporte'         => $faker->optional()->regexify('[A-Z0-9]{8}'), // Código ficticio
                'licencia'          => $faker->optional()->regexify('[A-Z0-9]{10}'),
                'email'             => $faker->email,
                'telefono'          => $faker->phoneNumber,
                'direccion_1'       => $faker->address,
                'direccion_2'       => $faker->optional()->secondaryAddress, // Puede ser nulo
                'ciudad_pueblo'     => $faker->city,
                'estado'            => $faker->state,
                'codigo_postal'     => $faker->postcode,
                'pais'              => $faker->country,
                'notas'             => $faker->optional()->text(200), // Texto descriptivo
                'pregunta_clave'    => $faker->boolean,
                'fecha_creacion'    => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'fecha_modificacion'=> $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
