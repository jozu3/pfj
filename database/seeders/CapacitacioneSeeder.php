<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Capacitacione;

class CapacitacioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Capacitacione::factory(500)->create();
    }
}
