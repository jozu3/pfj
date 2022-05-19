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
        $nom_m1 = 'Felix Manuel';
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





    }
}
