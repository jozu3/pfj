<?php

namespace Database\Seeders;

use App\Models\Barrio;
use Illuminate\Database\Seeder;
use App\Models\Inscripcione;
use App\Models\InscripcioneCompanerismo;
use App\Models\Personale;
use App\Models\Companerismo;
use App\Models\Programa;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Contacto;
use App\Models\Grupo;
use Faker\Generator as Faker;

class PersonaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        //matrimonios
        foreach (Programa::all() as $programa) {
            
            //esposo
            $mduser = User::factory(1)->create();
            $mduser[0]->assignRole('Matrimonio Director');
            $nombres = $faker->firstNameMale().' '.$faker->firstNameMale();
            $apellidos = $faker->lastName().' '.$faker->lastName();

            $mdcontacto = Contacto::create([
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'telefono' => '9'.$faker->randomNumber(8),
                'genero' => 'Hombre',
                'email' => $faker->unique()->safeEmail,
                'doc' => $faker->unique()->dni,
                'estado' => $faker->numberBetween($min = 1, $max = 3),
            ]);


            $personale = Personale:: create([
                'contacto_id' => $mdcontacto->id,
                'user_id' => $mduser[0]->id,
                'estado_rtemplo' => 1,
                'barrio_id' => Barrio::all()->random()->id,
            ]);

            
            $personale->user->update([
                'name' => $personale->contacto->nombres . ' ' . $personale->contacto->apellidos
            ]);

            Inscripcione::create([
                "personale_id" => $personale->id,
                "programa_id" => $programa->id,
                'role_id' => Role::find(2)->id,
                "estado" => 1,
                "fecha" => date('Y-m-d'),
            ]);
            
            //actualizar estado
            $personale->contacto->update([
                'email' => $mduser[0]->email,
                'estado' => 5
            ]);


            //esposa

            $mduser2 = User::factory(1)->create();
            $mduser2[0]->assignRole('Matrimonio Director');
            $nombres = $faker->firstNameFemale().' '.$faker->firstNameFemale();
            $apellidos = $faker->lastName().' '.$faker->lastName();

            $mdcontacto = Contacto::create([
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'telefono' => '9'.$faker->randomNumber(8),
                'genero' => 'Mujer',
                'email' => $faker->unique()->safeEmail,
                'doc' => $faker->unique()->dni,
                'estado' => $faker->numberBetween($min = 1, $max = 3),
            ]);


            $personale = Personale:: create([
                'contacto_id' => $mdcontacto->id,
                'user_id' => $mduser2[0]->id,
                'estado_rtemplo' => 1,
                'barrio_id' => Barrio::all()->random()->id,
            ]);

            
            $personale->user->update([
                'name' => $personale->contacto->nombres . ' ' . $personale->contacto->apellidos
            ]);

            Inscripcione::create([
                "personale_id" => $personale->id,
                "programa_id" => $programa->id,
                'role_id' => Role::find(2)->id,
                "estado" => 1,
                "fecha" => date('Y-m-d'),
            ]);

            //actualizar estado
            $personale->contacto->update([
                'email' => $mduser2[0]->email,
                'estado' => 5 //inscrito
            ]);





        }


        //Crear compañerismos
        foreach (Grupo::all() as $grupo) {
            for ($i=0; $i < 5; $i++) { 
                Companerismo::create([
                    'numero' => ($i+1),
                    'nombre' => $faker->word(1),
                    'grupo_id'=> $grupo->id,
                    'role_id' => 6 //consejero
                ]);
            }
        }
        
        //por cada compañerimo dos consejeros
        foreach (Companerismo::all() as $companerismo) {

            //consejera
            $mduser2 = User::factory(1)->create();
            $mduser2[0]->assignRole('Consejero');
            $nombres = $faker->firstNameFemale().' '.$faker->firstNameFemale();
            $apellidos = $faker->lastName().' '.$faker->lastName();

            $mdcontacto = Contacto::create([
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'telefono' => '9'.$faker->randomNumber(8),
                'email' => $faker->unique()->safeEmail,
                'genero' => 'Mujer',
                'doc' => $faker->unique()->dni,
                'estado' => $faker->numberBetween($min = 1, $max = 3),
            ]);


            $personale = Personale:: create([
                'contacto_id' => $mdcontacto->id,
                'user_id' => $mduser2[0]->id,
                'estado_rtemplo' => 1,
                'barrio_id' => Barrio::all()->random()->id,
            ]);

            
            $personale->user->update([
                'name' => $personale->contacto->nombres . ' ' . $personale->contacto->apellidos
            ]);

            $inscripcione = Inscripcione::create([
                "personale_id" => $personale->id,
                "programa_id" => $companerismo->grupo->programa->id,
                'role_id' => 6,//consejero
                "estado" => 1,
                "fecha" => date('Y-m-d'),
            ]);

            //actualizar estado
            $personale->contacto->update([
                'email' => $mduser2[0]->email,
                'estado' => 5 //inscrito
            ]);


            InscripcioneCompanerismo::create([
                'inscripcione_id' => $inscripcione->id,
                'companerismo_id' => $companerismo->id,
            ]);



            //consejero
            $mduser = User::factory(1)->create();
            $mduser[0]->assignRole('Consejero');
            $nombres = $faker->firstNameMale().' '.$faker->firstNameMale();
            $apellidos = $faker->lastName().' '.$faker->lastName();

            $mdcontacto = Contacto::create([
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'telefono' => '9'.$faker->randomNumber(8),
                'email' => $faker->unique()->safeEmail,
                'genero' => 'Hombre',
                'doc' => $faker->unique()->dni,
                'estado' => $faker->numberBetween($min = 1, $max = 3),
            ]);


            $personale = Personale:: create([
                'contacto_id' => $mdcontacto->id,
                'user_id' => $mduser[0]->id,
                'estado_rtemplo' => 1,
                'barrio_id' => Barrio::all()->random()->id,
            ]);

            
            $personale->user->update([
                'name' => $personale->contacto->nombres . ' ' . $personale->contacto->apellidos
            ]);

            $inscripcione = Inscripcione::create([
                "personale_id" => $personale->id,
                "programa_id" => $companerismo->grupo->programa->id,
                'role_id' => 6,//consejero
                "estado" => 1,
                "fecha" => date('Y-m-d'),
            ]);
            
            //actualizar estado
            $personale->contacto->update([
                'email' => $mduser[0]->email,
                'estado' => 5
            ]);

            InscripcioneCompanerismo::create([
                'inscripcione_id' => $inscripcione->id,
                'companerismo_id' => $companerismo->id,
            ]);
        }
    

    }
}
