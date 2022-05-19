<?php

namespace Database\Seeders;

use App\Models\Barrio;
use App\Models\Contacto;
use App\Models\Inscripcione;
use App\Models\Personale;
use App\Models\Programa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class MatrimonioUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pln2 = Programa::where('nombre', 'PFJ Lima Norte Sesión 2')->first();
        
        $this->createPersonal( [
            'nom_m1' => 'Ricardo Enmanuel',
            'ape_m1' => 'Neyra Aliaga',
            'correo_m1' => 'aryen.pan@gmail.com',
            'tel_m1' => '923060776',
            'barrio' => 'La Mar Ward',
            'rol' => 'Matrimonio Director',
            'genero' => 'Hombre',
        ], $pln2);

        $this->createPersonal( [
            'nom_m1' => 'Jackeline Paola',
            'ape_m1' => 'Mercado de Neyra',
            'correo_m1' => 'paola_3000@hotmail.com',
            'tel_m1' => '923060776',
            'barrio' => 'La Mar Ward',
            'rol' => 'Matrimonio Director',
            'genero' => 'Mujer',
        ], $pln2);


    }

    private function createPersonal($personale, $programa){
        //Manuel Mandujano
        $nom_m1 = $personale['nom_m1'];
        $ape_m1 = $personale['ape_m1'];
        $correo_m1 = $personale['correo_m1'];
        $tel_m1 = $personale['tel_m1'];
        $barrio = $personale['barrio'];
        $rol = $personale['rol'];
        $genero = $personale['genero'];

        $user = User::create([
            'name' => $nom_m1.' '.$ape_m1,
            'email' => $correo_m1,
            'estado' => 1,
            'password' => bcrypt('password')
        ]);
        $user->assignRole($rol);


        $contacto = Contacto::create([
            'nombres' => $nom_m1,
            'apellidos' => $ape_m1,
            'telefono' => $tel_m1,
            'email' => $user->email,
            'doc' => '',
            'genero' => $genero,
            'estado' => 3,
        ]);

        $personale = Personale::create([
            'permiso_obispo' => 1,
            'estado_rtemplo' => 1,
            'preinscripcion' => 1,
            'barrio_id' => Barrio::where('nombre', $barrio)->first()->id,
            'contacto_id' => $contacto->id,
            'user_id' => $user->id,
        ]);

        $inscripcione = Inscripcione::create([
            'personale_id' => $personale->id,
            'programa_id' => $programa->id,
            'role_id' => Role::where('name', $rol)->first()->id,
            'estado' => 1,
            'fecha' => date('Y-m-d')
        ]);

 }
}
