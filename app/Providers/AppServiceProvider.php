<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Personale;
use App\Models\Contacto;
use App\Models\Inscripcione;
use App\Models\Seguimiento;
use App\Models\Obligacione;
use App\Models\Programa;
use App\Observers\PersonaleObserver;
use App\Observers\ContactoObserver;
use App\Observers\InscripcioneObserver;
use App\Observers\SeguimientoObserver;
use App\Observers\ObligacioneObserver;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
               
            $menu_contactos = [
                'text' => 'Lista de contactos',
                'key' => 'list_contacts',
                'label_color' => 'success',
                'route'  => 'admin.contactos.index',
                'icon' => 'fas fa-fw fa-user',
                'can'  =>   'admin.contactos.index'
            ];

            // if (auth()->user()->hasRole(['Admin', 'Asistente', 'Vendedor'])) {
                   
            //     //$nuevos = Contacto::whereIn('estado', [1,2,3,4])->where('newassign', '1')->where('personal_id', auth()->user()->personal->id)->count();
            //     $nuevos = 0;
            //     if ($nuevos > 0) {
            //         $menu_contactos['label'] = $nuevos;
            //     }

            // }   
            // $event->menu->addAfter('inscripcion', $menu_contactos);

            if(auth()->user()->personale && auth()->user()->can(['admin.programas.misprogramas'])){

                $text_menu_sesion = 'Sesión';
                // session()->put('programa', $inscripciones[0]->programa->id);
                
                $missesiones = [];
                if(auth()->user()->can(['admin.programas.viewList'])){
                    foreach (Programa::all() as $programa) {
                        array_push($missesiones, [
                            'text'  => $programa->nombre,
                            'url' =>    '/admin/programas/changesession/'.$programa->id,
                            // 'route' => ['admin.users.changesesion', 'programa' => $inscripcione->programa],
                            // 'icon'  => 'fas  fa-users',
                        ]);
                    }
                } else {
                    $inscripciones = auth()->user()->personale->inscripciones;
                    foreach ($inscripciones as $inscripcione) {
                        array_push($missesiones, [
                            'text'  => $inscripcione->programa->nombre,
                            'url' =>    '/admin/programas/changesession/'.$inscripcione->programa->id,
                            // 'route' => ['admin.users.changesesion', 'programa' => $inscripcione->programa],
                            // 'icon'  => 'fas  fa-users',
                        ]);
                    }
                    
                    if (count($inscripciones) == 1) {
                        session(['programa_activo' => $inscripciones->first()->programa->id]);
                    }
                }
                
                if(session('programa_activo')){
                    $text_menu_sesion = Programa::find(session('programa_activo'))->nombre;
                    //AGREGAR MENUS DE SESION
                    $menu_configuracion = [
                        'text' => 'Mi sesión',
                        'url' => '/admin/programas/'.session('programa_activo').'/edit',
                        'icon' => 'fas fa-cogs',
                        'can'  =>   'admin.programas.edit'
                    ];
                    
                    $menu_organigrama = [
                        'text' => 'Organigrama',
                        'url' => '/admin/programas/'.session('programa_activo').'/asignar',
                        // 'route'  => ['admin.programas.asignar', $programa_activo],
                        'icon' => 'fas fa-sitemap',
                        'can'  =>   'admin.programas.misprogramas'
                    ];
                    
                    $menu_personales = [
                        'text' => 'Personal',
                        'url' => '/admin/programas/'.session('programa_activo').'/personal',
                        // 'route'  => ['admin.programas.asignar', $programa_activo],
                        'icon' => 'fas fa-users',
                        'can'  =>   'admin.programas.misprogramas'
                    ];
                    
                    
                    $menu_anuncios = [
                        'text' => 'Anuncios',
                        'route' => 'admin.anuncios.index',
                        'icon' => 'fas fa-chalkboard-teacher',
                        'can' => 'admin.anuncios.index'
                    ];
                    
                    $menu_asistencias = [
                        'text' => 'Control',
                        'url' => 'admin/programas/'.session('programa_activo'),
                        'icon' => 'fas fa-calendar-check',
                        'can' => 'admin.asistencias.index'
                    ];

                    $menu_tareas = [
                        'text' => 'Lecturas/Tareas',
                        'url' => 'admin/programas/'.session('programa_activo').'/tareas',
                        'icon' => 'fas fa-tasks',
                        'can' => 'admin.actividades.index'
                    ];

                    $menu_funciones = [
                        'text' => 'Funciones',
                        'url' => 'admin/programas/'.session('programa_activo').'/funciones',
                        'icon' => 'fas fa-tasks',
                        'can' => 'admin.funciones.index'
                    ];
                    
                    $menu_dashboard = [
                        'text' => 'Dashboard',
                        'url' => 'admin/programas/'.session('programa_activo').'/dashboard',
                        'icon' => 'fas fa-chart-line',
                        'can' => 'admin.programas.edit'
                    ];

                    /* * */
                    $menu_planificador = [
                        'text' => 'Planificador',
                        'url' => 'admin/programas/'.session('programa_activo').'/planificador',
                        'icon' => 'fas fa-chart-line',
                        'can' => 'admin.programas.planning'
                    ];

                    $header = [ 
                        'header' => 'Dashboard',
                        'can'  =>   'admin.programas.edit',
                        'key' => 'dashboard'
                    ];
                    
                    
                    $event->menu->addAfter('programa', $menu_funciones);
                    $event->menu->addAfter('programa', $menu_tareas);
                    $event->menu->addAfter('programa', $menu_asistencias);
                    $event->menu->addAfter('programa', $menu_anuncios);
                    $event->menu->addAfter('programa', $menu_organigrama);
                    $event->menu->addAfter('programa', $menu_personales);
                    $event->menu->addAfter('programa', $menu_configuracion);
                    $event->menu->addBefore('programa', $header);
                    $event->menu->addAfter('dashboard', $menu_dashboard);

                }   

                $menu_change_sesion = [
                    'text' => $text_menu_sesion,
                    'topnav' => 'true',
                    'classes' => 'btn btn-yellow-pfj',
                    'submenu' => $missesiones
                ];

                $event->menu->addAfter('programa', $menu_change_sesion);
                
                
            }
            
            
            
            
        });
        
        
        Personale::observe(PersonaleObserver::class);
        Inscripcione::observe(InscripcioneObserver::class);
        Seguimiento::observe(SeguimientoObserver::class);
        Contacto::observe(ContactoObserver::class);
        Obligacione::observe(ObligacioneObserver::class);
    }
}
