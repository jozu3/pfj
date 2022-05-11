<?php

namespace Database\Seeders;

use App\Models\Pfj;
use App\Models\Programa;
use Illuminate\Database\Seeder;

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
            Programa::create([
                'pfj_id' => $pfj->id,
                'nombre' => 'PFJ Lima Norte Sesión 1',
                'fecha_inicio' => '2022-07-25',
                'fecha_fin' => '2022-07-29',
                'estado' => 0
            ]);
        }

        if(!Programa::where('nombre', 'PFJ Lima Norte Sesión 2')->count()){

            Programa::create([
                'pfj_id' => $pfj->id,
                'nombre' => 'PFJ Lima Norte Sesión 2',
                'fecha_inicio' => '2022-08-01',
                'fecha_fin' => '2022-08-05',
                'estado' => 0
            ]);
        }
        if(!Programa::where('nombre', 'PFJ Lima Norte Sesión 3')->count()){

            Programa::create([
                'pfj_id' => $pfj->id,
                'nombre' => 'PFJ Lima Norte Sesión 3',
                'fecha_inicio' => '2022-08-01',
                'fecha_fin' => '2022-08-05',
                'estado' => 0
            ]);
        }
    }
}
