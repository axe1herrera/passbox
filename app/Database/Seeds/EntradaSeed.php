<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class EntradaSeed extends Seeder
{
    public function run()
    {
// Cargar el generador de Faker
 $faker = Factory::create();

 $entradaModel = model('EntradaModel');

// Insertamos múltiples registros de datos ficticios
 for ($i = 0; $i < 50; $i++) {
        $entradaModel->insert([
            'nombre' => $faker->name,
            'tipo' => $faker->randomElement(['Login', 'Identidad','Tarjeta', 'Nota']),
//            'correo' => $faker->email,
//            'telefono' => $faker->phoneNumber,
//            'contra' => password_hash('contra', PASSWORD_DEFAULT), // Genera una contraseña genérica
            'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            'updated_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
        ]);
    }
}
}
