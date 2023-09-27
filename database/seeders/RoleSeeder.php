<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role1 = Role::create(['name' => 'Admin', 'slug' => 'admin']);
        $role2 = Role::create(['name' => 'Matrimonio Director', 'slug' => 'mdirector']);
        $role3 = Role::create(['name' => 'Matrimonio de Logística', 'slug' => 'mlogistica']);
        $role4 = Role::create(['name' => 'Coordinador', 'slug' => 'coordinador']);
        $role5 = Role::create(['name' => 'Coordinador auxiliar', 'slug' => 'cordauxiliar']);
        $role6 = Role::create(['name' => 'Consejero', 'slug' => 'consejero']);        
        $role7 = Role::create(['name' => 'Obispo', 'slug' => 'obispo']);        
        $role8 = Role::create(['name' => 'Matrimonio de apoyo', 'slug' => 'matrimonio_apoyo']);        

        Permission::create(['name' => 'admin.home', 'description' => 'Ver el panel administratico'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6, $role7]);

        //Permisos USUARIO
        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.create', 'description' => 'Crear usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Editar usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.destroy', 'description' => 'Eliminar usuarios'])->syncRoles([$role1]);
        //Permisos ROL
        Permission::create(['name' => 'admin.roles.index', 'description' => 'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.create', 'description' => 'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit', 'description' => 'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.destroy', 'description' => 'Eliminar roles'])->syncRoles([$role1]);
        
        //Permisos Contacto
        Permission::create(['name' => 'admin.contactos.index', 'description' => 'Ver listado de contactos'])->syncRoles([$role1, $role2, $role3, $role4, $role7]);
        Permission::create(['name' => 'admin.contactos.create', 'description' => 'Crear contactos'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.contactos.edit', 'description' => 'Editar contactos'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.contactos.editAll', 'description' => 'Editar cualquier contacto'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.contactos.destroy', 'description' => 'Eliminar Contactos'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.contactos.destroyAll', 'description' => 'Eliminar cualquier contacto'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.contactos.contactos_barrio', 'description' => 'Ver contactos de su barrio'])->syncRoles([$role1, $role2, $role7]);
        Permission::create(['name' => 'admin.contactos.allcontactos', 'description' => 'Ver todos los contactos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.contactos.aprobacionobispo', 'description' => 'Aprobación por el obispo de un contacto'])->syncRoles([$role1, $role2, $role7]);
        Permission::create(['name' => 'admin.contactos.aprobacionpfj', 'description' => 'Aprobar contacto y enviar al obispo'])->syncRoles([$role1, $role2]);
        
        //Permisos Seguimiento
        Permission::create(['name' => 'admin.seguimientos.index', 'description' => 'Ver listado de comentarios'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.seguimientos.create', 'description' => 'Crear comentarios'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.seguimientos.edit', 'description' => 'Editar comentarios'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.seguimientos.destroy', 'description' => 'Eliminar comentarios'])->syncRoles([$role1, $role2, $role3]);
        
        //Permisos personale
        Permission::create(['name' => 'admin.personales.index', 'description' => 'Ver listado de personales'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.personales.create', 'description' => 'Crear personales'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.personales.edit', 'description' => 'Editar personales'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.personales.destroy', 'description' => 'Eliminar personales'])->syncRoles([$role1, $role2, $role3, $role4]);

        //Permisos pfj
        Permission::create(['name' => 'admin.pfjs.index', 'description' => 'Ver listado de pfjs'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.pfjs.create', 'description' => 'Crear pfjs'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.pfjs.edit', 'description' => 'Editar pfjs'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.pfjs.destroy', 'description' => 'Eliminar pfjs'])->syncRoles([$role1]);

        //Permisos programa/sesion
        Permission::create(['name' => 'admin.programas.index', 'description' => 'Ver listado de programas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.programas.create', 'description' => 'Crear programas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.programas.edit', 'description' => 'Editar programas'])->syncRoles([$role1, $role2,$role3, $role4]);
        Permission::create(['name' => 'admin.programas.destroy', 'description' => 'Eliminar programas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.programas.viewList', 'description' => 'Ver lista de personales de todos los programas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.programas.misprogramas', 'description' => 'Ver mis sesiones'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.programas.grupos', 'description' => 'Ver los grupos de su sesión'])->syncRoles([$role1, $role2, $role3, $role4, ]);
        Permission::create(['name' => 'admin.programas.planning', 'description' => 'Ver el menu planificador'])->syncRoles([$role1, $role2, $role3, $role4, ]);
        Permission::create(['name' => 'admin.programas.participantes', 'description' => 'Ver el menu participante del programa'])->syncRoles([$role1, $role2, $role3, $role4, ]);
        Permission::create(['name' => 'admin.programas.companias', 'description' => 'Ver las compañias del programa'])->syncRoles([$role1, $role2, $role3, $role4]);
        
        
        //Permisos grupo
        Permission::create(['name' => 'admin.grupos.index', 'description' => 'Ver listado de grupos'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.grupos.create', 'description' => 'Crear grupos'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.grupos.edit', 'description' => 'Editar grupos'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.grupos.destroy', 'description' => 'Eliminar grupos'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.grupos.migrupo', 'description' => 'Ver el grupo del que es coordinador auxiliar'])->syncRoles([$role1, $role4, $role5]);


        //Permisos inscripciones
        Permission::create(['name' => 'admin.inscripciones.index', 'description' => 'Ver listado de inscripciones'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.inscripciones.create', 'description' => 'Crear inscripciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.inscripciones.createAll', 'description' => 'Crear inscripciones de cualquier contacto'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.inscripciones.edit', 'description' => 'Editar inscripciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.inscripciones.destroy', 'description' => 'Eliminar inscripciones'])->syncRoles([$role1, $role2, $role3, $role4]);

        //Permisos inscripciones compañerismo
        Permission::create(['name' => 'admin.inscripcioneCompanerismos.index', 'description' => 'Ver listado de personale grupos'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.inscripcioneCompanerismos.create', 'description' => 'Crear personale grupos'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.inscripcioneCompanerismos.edit', 'description' => 'Editar personale grupos'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.inscripcioneCompanerismos.destroy', 'description' => 'Eliminar personale grupos'])->syncRoles([$role1, $role2, $role3, $role4]);

         //Permisos capacitaciones
        Permission::create(['name' => 'admin.capacitaciones.index', 'description' => 'Ver listado de capacitaciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.capacitaciones.create', 'description' => 'Crear capacitaciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.capacitaciones.edit', 'description' => 'Editar capacitaciones'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.capacitaciones.destroy', 'description' => 'Eliminar capacitaciones'])->syncRoles([$role1, $role2, $role3, $role4]);

        //Permisos asistencias
        Permission::create(['name' => 'admin.asistencias.index', 'description' => 'Ver listado de asistencias'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.asistencias.create', 'description' => 'Crear asistencias'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.asistencias.edit', 'description' => 'Editar asistencias'])->syncRoles([$role1, $role2, $role3, $role4,]);
        Permission::create(['name' => 'admin.asistencias.destroy', 'description' => 'Eliminar asistencias'])->syncRoles([$role1, $role2, $role3, $role4]);
        //coordinador auxiliar
        Permission::create(['name' => 'admin.asistencias.migrupo', 'description' => 'Marcar las asistencias solo de mi familia'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
 

        //Permisos anuncios
        Permission::create(['name' => 'admin.anuncios.index', 'description' => 'Ver listado de anuncios'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.anuncios.create', 'description' => 'Crear anuncios'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.anuncios.edit', 'description' => 'Editar anuncios'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.anuncios.destroy', 'description' => 'Eliminar anuncios'])->syncRoles([$role1, $role2, $role3, $role4]);
        
        //Permisos actividades
        Permission::create(['name' => 'admin.actividades.index', 'description' => 'Ver listado de actividades'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.actividades.create', 'description' => 'Crear actividades'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.actividades.edit', 'description' => 'Editar actividades'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.actividades.destroy', 'description' => 'Eliminar actividades'])->syncRoles([$role1, $role2, $role3, $role4]);
  

        //Permisos admin.reportes.index
        Permission::create(['name' => 'admin.reportes.index', 'description' => 'Ver listado de reportes'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);

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

        //locales
        Permission::create(['name' => 'admin.locales.index', 'description' => 'Ver listado de locales'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.locales.create', 'description' => 'Crear locales'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.locales.edit', 'description' => 'Editar locales'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.locales.destroy', 'description' => 'Eliminar locales'])->syncRoles([$role1]);

        //edificios
        Permission::create(['name' => 'admin.edificios.index', 'description' => 'Ver listado de edificios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.edificios.create', 'description' => 'Crear edificios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.edificios.edit', 'description' => 'Editar edificios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.edificios.destroy', 'description' => 'Eliminar edificios'])->syncRoles([$role1]);

        //pisos
        Permission::create(['name' => 'admin.pisos.index', 'description' => 'Ver listado de pisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.pisos.create', 'description' => 'Crear pisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.pisos.edit', 'description' => 'Editar pisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.pisos.destroy', 'description' => 'Eliminar pisos'])->syncRoles([$role1]);

        //habitaciones
        Permission::create(['name' => 'admin.habitaciones.index', 'description' => 'Ver listado de habitaciones'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.habitaciones.create', 'description' => 'Crear habitaciones'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.habitaciones.edit', 'description' => 'Editar habitaciones'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.habitaciones.destroy', 'description' => 'Eliminar habitaciones'])->syncRoles([$role1]);

        // permisos comentarios
        Permission::create(['name' => 'admin.comentarios.index', 'description' => 'Ver listado de comentarios'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.comentarios.create', 'description' => 'Crear comentarios'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.comentarios.edit', 'description' => 'Editar comentarios'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.comentarios.destroy', 'description' => 'Eliminar comentarios'])->syncRoles([$role1, $role2, $role3, $role4]);
        
    }
}
