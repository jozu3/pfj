<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pfj;


class PfjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pfj::factory(5)->create();
    }
}
