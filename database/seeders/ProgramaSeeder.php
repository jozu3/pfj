<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Programa;
use App\Models\Pfj;
use Faker\Generator as Faker;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //Programa::factory(20)->create();$j = 0;

        for ($i=0; $i < 20; $i++) { 
            
            $estado = 0;

            $fecha_inicio = $faker->dateTimeThisYear($max = '2022-07-31', $timezone = null)->format('Y-m-d');
    
            //sumas 5 días - fecha de fin
            $fecha_fin =  date("Y-m-d",strtotime($fecha_inicio."+ 5 days")); 
    

            if($fecha_inicio < date("Y-m-d")){
                $estado = 1;
            }

            if($fecha_fin < date("Y-m-d")){
                $estado = 2;
            }
    
    
            $nombre_sesiones = [
                'Lima Norte',
                'Lima Oeste',
                'Lima Central',
                'Lima Este',
                'Limatambo',
                'Trujillo Norte',
                'Trujillo Sur',
                'Bolivia La Paz',
            ];
    
            $nombre = 'PFJ '.$faker->randomElement($nombre_sesiones);
    
            $cant = Programa::where('nombre', 'like', $nombre.'%')->count();

            if($cant >= 1 ){
                $cant = $cant +1;
                $nombre = $nombre . ' ' . $cant;
            }
            

            Programa::create([
                'pfj_id' => Pfj::all()->random()->id,
                'nombre' => $nombre,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'estado' => $estado,
            ]);
        }
    }
}
