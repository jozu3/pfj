<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(PermissionPersonaleSeeder::class);
        $this->call(BarrioSeeder::class);
        $this->call(UserSeeder::class);
        
        $this->call(ContactoSeeder::class);
        $this->call(PfjSeeder::class);
        $this->call(ProgramaSeeder::class);
        $this->call(GrupoSeeder::class);
        $this->call(PersonaleSeeder::class);
        $this->call(CapacitacioneSeeder::class);
      /*$this->call(CuentaSeeder::class);
        $this->call(PagoSeeder::class);*/
    }
}