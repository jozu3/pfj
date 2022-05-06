<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionPersonaleSeeder::class);
        $this->call(BarrioSeeder::class);
        $this->call(UserSeeder::class);
    }
}
