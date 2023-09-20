<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::find(1);
        $role2 = Role::find(2);
        $role3 = Role::find(3);
        $role4 = Role::find(4);
        $role5 = Role::find(5);
        $role6 = Role::find(6);
        $role7 = Role::find(7);
        $role8 = Role::find(8);

        //Permisos materiales
        Permission::create(['name' => 'admin.materiales.index', 'description' => 'Ver listado de materiales'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.materiales.create', 'description' => 'Crear materiales'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.materiales.edit', 'description' => 'Editar materiales'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.materiales.destroy', 'description' => 'Eliminar materiales'])->syncRoles([$role1, $role2, $role3, $role4]);

        //funciones
        Permission::create(['name' => 'admin.funciones.index', 'description' => 'Ver listado de funciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.funciones.create', 'description' => 'Crear funciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.funciones.edit', 'description' => 'Editar funciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.funciones.destroy', 'description' => 'Eliminar funciones'])->syncRoles([$role1, $role2, $role3, $role4]);


        
        Permission::create(['name' => 'admin.programas.planning', 'description' => 'Ver el menu planificador'])->syncRoles([$role1, $role2, $role3, $role4, ]);
   
    }
}
