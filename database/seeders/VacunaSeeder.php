<?php

namespace Database\Seeders;

use App\Models\Vacuna;
use Illuminate\Database\Seeder;

class VacunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dosis de COVID
        $vacuna = Vacuna::create(['descripcion' => '1 Dosis']);
        $vacuna = Vacuna::create(['descripcion' => '2 Dosis']);
        $vacuna = Vacuna::create(['descripcion' => '3 Dosis']);
    }
}
