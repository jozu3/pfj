<?php

namespace Database\Seeders;

use App\Models\Barrio;
use App\Models\ConsejoCoordinacione;
use App\Models\Estaca;
use Illuminate\Database\Seeder;

class BarrioExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $cclimaeste = ConsejoCoordinacione::create([
            'nombre' => 'Lima Este'
        ]);

        $cclimacentral = ConsejoCoordinacione::create([
            'nombre' => 'Lima Central'
        ]);

    
        //Lima Este
        $eCampoy = Estaca::create(['nombre' => 'Campoy', 'consejo_coordinacione_id' => $cclimaeste->id]);
        //Lima Central
        $eIndependencia = Estaca::create(['nombre' => 'Independencia', 'consejo_coordinacione_id' => $cclimacentral->id]);



        //Lima Campoy Stake
        Barrio::create(['nombre' => 'Campoy Ward', 'estaca_id' => $eCampoy->id]);
        Barrio::create(['nombre' => 'El Valle Ward', 'estaca_id' => $eCampoy->id]);
        Barrio::create(['nombre' => 'Huachipa Ward', 'estaca_id' => $eCampoy->id]);
        Barrio::create(['nombre' => 'Mangomarca Ward', 'estaca_id' => $eCampoy->id]);
        Barrio::create(['nombre' => 'Portada del Sol Ward', 'estaca_id' => $eCampoy->id]);

        //Lima Independencia Stake
        Barrio::create(['nombre' => 'Diecisiete de Noviembre Ward', 'estaca_id' => $eIndependencia->id]);
        Barrio::create(['nombre' => 'Independencia Ward', 'estaca_id' => $eIndependencia->id]);
        Barrio::create(['nombre' => 'José Gálvez Ward', 'estaca_id' => $eIndependencia->id]);
        Barrio::create(['nombre' => 'La Magnolias Ward', 'estaca_id' => $eIndependencia->id]);
        Barrio::create(['nombre' => 'Las Violetas Ward', 'estaca_id' => $eIndependencia->id]);
        Barrio::create(['nombre' => 'Los Pinos Ward', 'estaca_id' => $eIndependencia->id]);

   
    }
}
