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

        // //Permisos materiales
        // Permission::create(['name' => 'admin.materiales.index', 'description' => 'Ver listado de materiales'])->syncRoles([$role1, $role2, $role3, $role4]);
        // Permission::create(['name' => 'admin.materiales.create', 'description' => 'Crear materiales'])->syncRoles([$role1, $role2, $role3, $role4]);
        // Permission::create(['name' => 'admin.materiales.edit', 'description' => 'Editar materiales'])->syncRoles([$role1, $role2, $role3, $role4]);
        // Permission::create(['name' => 'admin.materiales.destroy', 'description' => 'Eliminar materiales'])->syncRoles([$role1, $role2, $role3, $role4]);

        // //funciones
        // Permission::create(['name' => 'admin.funciones.index', 'description' => 'Ver listado de funciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        // Permission::create(['name' => 'admin.funciones.create', 'description' => 'Crear funciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        // Permission::create(['name' => 'admin.funciones.edit', 'description' => 'Editar funciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        // Permission::create(['name' => 'admin.funciones.destroy', 'description' => 'Eliminar funciones'])->syncRoles([$role1, $role2, $role3, $role4]);


        
        // Permission::create(['name' => 'admin.programas.planning', 'description' => 'Ver el menu planificador'])->syncRoles([$role1, $role2, $role3, $role4, ]);
   

          
        // permisos consejo_coordinaciones
        Permission::create(['name' => 'admin.consejo_coordinaciones.index', 'description' => 'Ver listado de consejo de coordinación'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.consejo_coordinaciones.create', 'description' => 'Crear consejo de coordinación'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.consejo_coordinaciones.edit', 'description' => 'Editar consejo de coordinación'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.consejo_coordinaciones.destroy', 'description' => 'Eliminar consejo de coordinación'])->syncRoles([$role1]);

        // permisos estacas
        Permission::create(['name' => 'admin.estacas.index', 'description' => 'Ver listado de estacas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.estacas.create', 'description' => 'Crear estacas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.estacas.edit', 'description' => 'Editar estacas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.estacas.destroy', 'description' => 'Eliminar estacas'])->syncRoles([$role1]);

        // permisos barrios
        Permission::create(['name' => 'admin.barrios.index', 'description' => 'Ver listado de barrios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.barrios.create', 'description' => 'Crear barrios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.barrios.edit', 'description' => 'Editar barrios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.barrios.destroy', 'description' => 'Eliminar barrios'])->syncRoles([$role1]);


    }
}
