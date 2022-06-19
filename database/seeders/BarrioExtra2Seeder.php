<?php

namespace Database\Seeders;

use App\Models\Barrio;
use App\Models\ConsejoCoordinacione;
use App\Models\Estaca;
use Illuminate\Database\Seeder;

class BarrioExtra2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cclimaoeste = ConsejoCoordinacione::create([
            'nombre' => 'Lima Oeste'
        ]);

        //Lima Oeste
        $eNaranjal = Estaca::create(['nombre' => 'Naranjal', 'consejo_coordinacione_id' => $cclimaoeste->id]);

     //Lima Naranjal Stake
        Barrio::create(['nombre' => 'Canta Callao Ward', 'estaca_id' => $eNaranjal->id]);
        Barrio::create(['nombre' => 'Huandoy Ward', 'estaca_id' => $eNaranjal->id]);
        Barrio::create(['nombre' => 'Los Próceres Ward', 'estaca_id' => $eNaranjal->id]);
        Barrio::create(['nombre' => 'Márquez Ward', 'estaca_id' => $eNaranjal->id]);
        Barrio::create(['nombre' => 'Naranjal Ward', 'estaca_id' => $eNaranjal->id]);
        Barrio::create(['nombre' => 'Oquendo Ward', 'estaca_id' => $eNaranjal->id]);
        
    }
}
