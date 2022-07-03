<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ParticipanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role7 = Role::create(['name' => 'Participante', 'slug' => 'participante']);        

        //permisos
        //  
        
    }
}
