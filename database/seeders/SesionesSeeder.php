<?php

namespace Database\Seeders;

use App\Models\Barrio;
use App\Models\Contacto;
use App\Models\Inscripcione;
use App\Models\Personale;
use App\Models\Pfj;
use App\Models\Programa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SesionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Pfj::where('nombre', 'PFJ 2022')->count())
        {
            $pfj = Pfj::create([
                'nombre' => 'PFJ 2022',
                'lema' => '“Confía en Jehová con todo tu corazón, y no te apoyes en tu propia prudencia. Reconócelo en todos tus caminos, y él enderezará tus veredas”. PROVERBIOS 3:5–6',
                'lema_abreviado' => 'Confía en Jehová',
                'estado' => 1
            ]);
        } else {
            $pfj = Pfj::where('nombre', 'PFJ 2022')->first();
        }

        if(!Programa::where('nombre', 'PFJ Lima Norte Sesión 1')->count()){
            $pln1 = Programa::create([
                'pfj_id' => $pfj->id,
                'nombre' => 'PFJ Lima Norte Sesión 1',
                'fecha_inicio' => '2022-07-25',
                'fecha_fin' => '2022-07-29',
                'estado' => 0
            ]);
        }

        if(!Programa::where('nombre', 'PFJ Lima Norte Sesión 2')->count()){

            $pln2 = Programa::create([
                'pfj_id' => $pfj->id,
                'nombre' => 'PFJ Lima Norte Sesión 2',
                'fecha_inicio' => '2022-08-01',
                'fecha_fin' => '2022-08-05',
                'estado' => 0
            ]);
        }
        if(!Programa::where('nombre', 'PFJ Lima Norte Sesión 3')->count()){

            $pln3 = Programa::create([
                'pfj_id' => $pfj->id,
                'nombre' => 'PFJ Lima Norte Sesión 3',
                'fecha_inicio' => '2022-08-01',
                'fecha_fin' => '2022-08-05',
                'estado' => 0
            ]);
        }

        //Manuel Mandujano
        $nom_m1 = 'Félix Manuel';
        $ape_m1 = 'Mandujano Urquiaga';
        $correo_m1 = 'manuelfmu@gmail.com';
        $tel_m1 = '936851538';
        $barrio = 'Belaunde Ward';
        $rol = 'Matrimonio Director';
        $genero = 'Hombre';

        $user_admin_1 = User::create([
            'name' => $nom_m1.' '.$ape_m1,
            'email' => $correo_m1,
            'estado' => 1,
            'password' => bcrypt('password')
        ]);
        $user_admin_1->assignRole($rol);


        $contacto = Contacto::create([
            'nombres' => $nom_m1,
            'apellidos' => $ape_m1,
            'telefono' => $tel_m1,
            'email' => $user_admin_1->email,
            'doc' => '',
            'genero' => $genero,
            'estado' => 3,
        ]);

        $personale = Personale::create([
            'permiso_obispo' => 1,
            'estado_rtemplo' => 1,
            'barrio_id' => Barrio::where('nombre', $barrio)->first()->id,
            'contacto_id' => $contacto->id,
            'user_id' => $user_admin_1->id,
        ]);

        $inscripcione = Inscripcione::create([
            'personale_id' => $personale->id,
            'programa_id' => $pln3->id,
            'role_id' => Role::where('name', $rol)->first()->id,
            'estado' => 1,
            'fecha' => date('Y-m-d')
        ]);

        $this->createPersonal( [
            'nom_m1' => 'Rosa Ysabel',
            'ape_m1' => 'Lucero Rivera',
            'correo_m1' => 'rosa@gmail.com',
            'tel_m1' => '972358750',
            'barrio' => 'Belaunde Ward',
            'rol' => 'Matrimonio Director',
            'genero' => 'Mujer',
        ], $pln3);


        $this->createPersonal( [
            'nom_m1' => 'Helmut',
            'ape_m1' => 'Perez Carrasco',
            'correo_m1' => 'helmutpc@gmail.com',
            'tel_m1' => '978967307',
            'barrio' => 'Belaunde Ward',
            'rol' => 'Matrimonio de Logística',
            'genero' => 'Hombre',
        ], $pln3);

        $this->createPersonal( [
            'nom_m1' => 'Rosario',
            'ape_m1' => 'Sanchez de Perez',
            'correo_m1' => 'rosario.sanchez.ch@gmail.com',
            'tel_m1' => '932729307',
            'barrio' => 'Belaunde Ward',
            'rol' => 'Matrimonio de Logística',
            'genero' => 'Mujer',
        ], $pln3);

        /*
        Matrimonio Director
        Matrimonio de Logística
        Cordinador
        Cordinador auxiliar
        Consejero
        
        */
    }

    public function createPersonal($personale, $programa){
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
