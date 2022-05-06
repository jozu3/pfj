<?php

namespace Database\Seeders;

use App\Models\Barrio;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Contacto;
use App\Models\Personale;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //Josué Vitate
        $nom_admin_1 = 'Josué';
        $ape_admin_1 = 'Vitate';

        $user_admin_1 = User::create([
            'name' => $nom_admin_1.' '.$ape_admin_1,
            'email' => 'josue.vitate@gmail.com',
            'estado' => 1,
            'password' => bcrypt('password')
        ]);
        $user_admin_1->assignRole('Admin');


        $contacto = Contacto::create([
            'nombres' => $nom_admin_1,
            'apellidos' => $ape_admin_1,
            'telefono' => '940185572',
            'email' => $user_admin_1->email,
            'doc' => $faker->unique()->dni,
            'genero' => 'Hombre',
            'estado' => 3,
        ]);

        $personale = Personale::create([
            'permiso_obispo' => 1,
            'estado_rtemplo' => 1,
            'barrio_id' => Barrio::where('nombre', 'La Mar Ward')->first()->id,
            'contacto_id' => $contacto->id,
            'user_id' => $user_admin_1->id,
        ]);

        //Marjorie Ynuma
        $nom_admin_2 = 'Marjorie Daselee';
        $ape_admin_2 = 'Ynuma';

        $user_admin_2 = User::create([
            'name' => $nom_admin_2.' '.$ape_admin_2,
            'email' => 'marjorie.mdyr@gmail.com',
            'estado' => 1,
            'password' => bcrypt('password')
        ]);
        $user_admin_2->assignRole('Admin');
        
        $contacto = Contacto::create([
            'nombres' => $nom_admin_2,
            'apellidos' => $ape_admin_2,
            'telefono' => '923731605',
            'email' => $user_admin_2->email,
            'doc' => $faker->unique()->dni,
            'genero' => 'Mujer',
            'estado' => 3,
        ]);

        $personale = Personale::create([
            'permiso_obispo' => 1,
            'estado_rtemplo' => 1,
            'barrio_id' => Barrio::where('nombre', 'Famesa 2nd Ward')->first()->id,
            'contacto_id' => $contacto->id,
            'user_id' => $user_admin_2->id,
        ]);

    }
}
