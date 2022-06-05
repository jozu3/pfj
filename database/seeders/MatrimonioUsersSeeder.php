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

        $pln3 = Programa::where('nombre', 'PFJ Lima Norte Sesión 3')->first();
        $pln2 = Programa::where('nombre', 'PFJ Lima Norte Sesión 2')->first();
        $pln1 = Programa::where('nombre', 'PFJ Lima Norte Sesión 1')->first();

        //Sesion 1
        if (!User::where('email', 'joslinovel@gmail.com')->first()) {

            $this->createPersonal([
                'nom_m1' => 'Jose Galvani',
                'ape_m1' => 'Lino Velasquez',
                'correo_m1' => 'joslinovel@gmail.com',
                'tel_m1' => '993275295',
                'barrio' => '--',
                'rol' => 'Matrimonio Director',
                'genero' => 'Hombre',
            ], $pln1);

            $this->createPersonal([
                'nom_m1' => 'Guisela Lourdes',
                'ape_m1' => 'Pastor Tarazona',
                'correo_m1' => 'guiselapastor@gmail.com',
                'tel_m1' => '993275295',
                'barrio' => '--',
                'rol' => 'Matrimonio Director',
                'genero' => 'Mujer',
            ], $pln1);
        }
        //Sesion 2
        if (!User::where('email', 'aryen.pan@gmail.com')->first()) {

            $this->createPersonal([
                'nom_m1' => 'Ricardo Enmanuel',
                'ape_m1' => 'Neyra Aliaga',
                'correo_m1' => 'aryen.pan@gmail.com',
                'tel_m1' => '923060776',
                'barrio' => 'La Mar Ward',
                'rol' => 'Matrimonio Director',
                'genero' => 'Hombre',
            ], $pln2);
        }
        if (!User::where('email', 'paola_3000@hotmail.com')->first()) {

            $this->createPersonal([
                'nom_m1' => 'Jackeline Paola',
                'ape_m1' => 'Mercado de Neyra',
                'correo_m1' => 'paola_3000@hotmail.com',
                'tel_m1' => '923060776',
                'barrio' => 'La Mar Ward',
                'rol' => 'Matrimonio Director',
                'genero' => 'Mujer',
            ], $pln2);
        }


        //Sesion 3

        //Manuel Mandujano
        if (!User::where('email', 'manuelfmu@gmail.com')->first()) {

            $this->createPersonal([
                'nom_m1' => 'Félix Manuel',
                'ape_m1' => 'Mandujano Urquiaga',
                'correo_m1' => 'manuelfmu@gmail.com',
                'tel_m1' => '936851538',
                'barrio' => 'Belaunde Ward',
                'rol' => 'Matrimonio Director',
                'genero' => 'Hombre',
            ], $pln3);
            $this->createPersonal([
                'nom_m1' => 'Rosa Ysabel',
                'ape_m1' => 'Lucero Rivera',
                'correo_m1' => 'rosa@gmail.com',
                'tel_m1' => '972358750',
                'barrio' => 'Belaunde Ward',
                'rol' => 'Matrimonio Director',
                'genero' => 'Mujer',
            ], $pln3);
            $this->createPersonal([
                'nom_m1' => 'Helmut',
                'ape_m1' => 'Perez Carrasco',
                'correo_m1' => 'helmutpc@gmail.com',
                'tel_m1' => '978967307',
                'barrio' => 'Belaunde Ward',
                'rol' => 'Matrimonio de Logística',
                'genero' => 'Hombre',
            ], $pln3);

            $this->createPersonal([
                'nom_m1' => 'Rosario',
                'ape_m1' => 'Sanchez de Perez',
                'correo_m1' => 'rosario.sanchez.ch@gmail.com',
                'tel_m1' => '932729307',
                'barrio' => 'Belaunde Ward',
                'rol' => 'Matrimonio de Logística',
                'genero' => 'Mujer',
            ], $pln3);
        }
    }

    private function createPersonal($personale, $programa)
    {
        //Manuel Mandujano
        $nom_m1 = $personale['nom_m1'];
        $ape_m1 = $personale['ape_m1'];
        $correo_m1 = $personale['correo_m1'];
        $tel_m1 = $personale['tel_m1'];
        $barrio = $personale['barrio'];
        $rol = $personale['rol'];
        $genero = $personale['genero'];

        $user = User::create([
            'name' => $nom_m1 . ' ' . $ape_m1,
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
        $barrio = Barrio::where('nombre', $barrio)->first();
        $personale = Personale::create([
            'permiso_obispo' => 1,
            'estado_rtemplo' => 1,
            'preinscripcion' => 1,
            'barrio_id' => $barrio != null ? $barrio->id : '1',
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
