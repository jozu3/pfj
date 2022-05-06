<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seguimiento;

class SeguimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seguimiento::factory(100)->create();
    }
}
