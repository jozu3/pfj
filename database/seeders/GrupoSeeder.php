<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grupo;
use App\Models\Programa;
use App\Models\InscripcioneCompanerismo;
use App\Models\Personale;
use Faker\Generator as Faker;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //$grupos = Grupo::factory(100)->create();

        foreach (Programa::all() as $programa) {
            for ($i=0; $i < 5; $i++) { 
                Grupo::create([
                    'nombre' => $faker->word(2),
                    'numero' => ($i+1),
                    'programa_id' => $programa->id,
                ]);
            }
        }
        

        // foreach ($grupos as $grupo){

		// 	InscripcioneCompanerismo::create([
        //         'grupo_id' => $grupo->id,
        //         'personale_id' => $faker->randomElement(Personale::all()->pluck('id'))
        //     ]);
        // }
    }
}
