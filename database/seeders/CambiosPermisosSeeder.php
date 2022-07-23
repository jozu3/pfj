<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CambiosPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $role1 = Role::where('name','Admin')->first();
        // $role2 = Role::where('name','Admin')->first();
        // $role3 = Role::where('name','Admin')->first();
        // $role4 = Role::where('name','Admin')->first();
        $role1 = Role::find(1);
        $role2 = Role::find(2);
        $role3 = Role::find(3);
        $role4 = Role::find(4);
        $role5 = Role::find(5);
        $role6 = Role::find(6);
        
        //locales
        // Permission::create(['name' => 'admin.locales.index', 'description' => 'Ver listado de locales'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.locales.create', 'description' => 'Crear locales'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.locales.edit', 'description' => 'Editar locales'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.locales.destroy', 'description' => 'Eliminar locales'])->syncRoles([$role1]);
        

        
        // //edificios
        // Permission::create(['name' => 'admin.edificios.index', 'description' => 'Ver listado de edificios'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.edificios.create', 'description' => 'Crear edificios'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.edificios.edit', 'description' => 'Editar edificios'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.edificios.destroy', 'description' => 'Eliminar edificios'])->syncRoles([$role1]);

        // //pisos
        // Permission::create(['name' => 'admin.pisos.index', 'description' => 'Ver listado de pisos'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.pisos.create', 'description' => 'Crear pisos'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.pisos.edit', 'description' => 'Editar pisos'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.pisos.destroy', 'description' => 'Eliminar pisos'])->syncRoles([$role1]);

        // //habitaciones
        // Permission::create(['name' => 'admin.habitaciones.index', 'description' => 'Ver listado de habitaciones'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.habitaciones.create', 'description' => 'Crear habitaciones'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.habitaciones.edit', 'description' => 'Editar habitaciones'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.habitaciones.destroy', 'description' => 'Eliminar habitaciones'])->syncRoles([$role1]);
        
        // //permiso para ver las compañias
        Permission::create(['name' => 'admin.programas.companias', 'description' => 'Ver las compañias del programa'])->syncRoles([$role1, $role2, $role3, $role4]);
    }
}