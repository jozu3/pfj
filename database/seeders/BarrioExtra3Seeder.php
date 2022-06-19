<?php

namespace Database\Seeders;

use App\Models\Barrio;
use App\Models\ConsejoCoordinacione;
use App\Models\Estaca;
use Illuminate\Database\Seeder;

class BarrioExtra3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cclimaeste = ConsejoCoordinacione::where('nombre', 'Lima Este')->first();

         //Lima Central
         $eLasFlores = Estaca::create(['nombre' => 'Las Flores', 'consejo_coordinacione_id' => $cclimaeste->id]);

         //Las Flores Stake
         Barrio::create(['nombre' => 'Las Flores Ward', 'estaca_id' => $eLasFlores->id]);
         Barrio::create(['nombre' => 'Caja de Agua Ward', 'estaca_id' => $eLasFlores->id]);
         Barrio::create(['nombre' => 'Los Jardines Ward', 'estaca_id' => $eLasFlores->id]);
         Barrio::create(['nombre' => 'Nueva Era Ward', 'estaca_id' => $eLasFlores->id]);
         Barrio::create(['nombre' => 'San Silvestre Ward', 'estaca_id' => $eLasFlores->id]);
         Barrio::create(['nombre' => 'Zárate Ward', 'estaca_id' => $eLasFlores->id]);
 

    }
}
