<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\PersonalAccessToken;
use PhpParser\Parser\Tokens;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => '123456789',
            'ci' => '9866021',
            'sexo' => 'M',
            'telefono' => '60522212',
            'tipo' => 'Empleado',
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Byron Lewis',
            'email' => 'b@gmail.com',
            'password' => '123456789',
            'ci' => '9866022',
            'sexo' => 'M',
            'telefono' => '60522222',
            'tipo' => 'Empleado',
        ])->assignRole('Supervisor');

        User::create([
            'name' => 'Cassady Bridges',
            'email' => 'c@gmail.com',
            'password' => '123456789',
            'ci' => '9866023',
            'sexo' => 'M',
            'telefono' => '60522223',
            'tipo' => 'Empleado',
        ])->assignRole('RRHH');

        User::create([
            'name' => 'Dawn Buckley',
            'email' => 'd@gmail.com',
            'password' => '123456789',
            'ci' => '9866024',
            'sexo' => 'M',
            'telefono' => '60522214',
            'tipo' => 'Empleado',
        ])->assignRole('Marketing');

        User::create([
            'name' => 'Erica Mosley',
            'email' => 'e@gmail.com',
            'password' => '123456789',
            'ci' => '9866025',
            'sexo' => 'M',
            'telefono' => '60522215',
            'tipo' => 'Empleado',
        ])->assignRole('Almacenador');

        User::create([
            'name' => 'Flavia Kirkland',
            'email' => 'f@gmail.com',
            'password' => '123456789',
            'ci' => '9866026',
            'sexo' => 'M',
            'telefono' => '60522216',
            'tipo' => 'Cliente',
        ]);

        User::create([
            'name' => 'Galvin Golden',
            'email' => 'g@gmail.com',
            'password' => '123456789',
            'ci' => '9866027',
            'sexo' => 'M',
            'telefono' => '60522217',
            'tipo' => 'Cliente',
        ]);

        PersonalAccessToken::create([
            'tokenable_type' => 'App\Models\User',
            'tokenable_id' => '7',
            'name' => 'auth_token',
            'token' => 'b1245a0ae33cd3b901b1db004cc12371ed800c078670d430b5b9141309890963',
            'abilities' => '["*"]',
            //'last_used_at' => ,
            //'created_at' => ,
           // 'updated_at' => ,
           // 'expires_at' => '7',
        ]);

        User::create([
            'name' => 'Juan Carlos Contreras ',
            'email' => 'm79832142l@gmail.com',
            'password' => '123456789',
            'ci' => '9866028',
            'sexo' => 'M',
            'telefono' => '60933372',
            'tipo' => 'Cliente',
        ]);

    }
}
