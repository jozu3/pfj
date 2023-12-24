<?php

namespace Database\Seeders;

use App\Models\EstadoAprobacione;
use Illuminate\Database\Seeder;

class EstadoAprobacioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoAprobacione::create(['descripcion' => 'Aprobados', 'estado' => '1']);
        EstadoAprobacione::create(['descripcion' => 'Aprobación pendiente', 'estado' => '1']);
        EstadoAprobacione::create(['descripcion' => 'En lista de espera', 'estado' => '1']);
        EstadoAprobacione::create(['descripcion' => 'Cancelado', 'estado' => '1']);
    }
}
