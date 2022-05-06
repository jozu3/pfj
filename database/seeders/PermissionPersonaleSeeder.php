<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionPersonaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**************************Permisos del personale*************************/
        $role1 = Role::where('name','Admin')->first();
        $role2 = Role::where('name','Matrimonio Director')->first();
        $role3 = Role::where('name','Matrimonio de Logística')->first();
        $role4 = Role::where('name','Cordinador')->first();
        $role5 = Role::where('name','Cordinador auxiliar')->first();
        $role6 = Role::where('name','Consejero')->first();

        //permisos 

        Permission::create(['name' => 'student.home', 'description' => 'Ingresar a perfil de estudiante'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6]);
        Permission::create(['name' => 'student.programas.index', 'description' => 'Ver sus programas'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6]);
        Permission::create(['name' => 'student.grupos.index', 'description' => 'Ver sus grupos'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6]);
        Permission::create(['name' => 'student.anuncios.index', 'description' => 'Ver todos los anuncios'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6]);
        Permission::create(['name' => 'student.capacitaciones.index', 'description' => 'Ver todos los anuncios'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6]);
        Permission::create(['name' => 'student.lecturas.index', 'description' => 'Ver sus lecturas'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6]);
        Permission::create(['name' => 'student.lecturas.edit', 'description' => 'Editar sus lecturas'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6]);


    }
}