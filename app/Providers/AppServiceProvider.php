<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Personale;
use App\Models\Contacto;
use App\Models\Inscripcione;
use App\Models\Seguimiento;
use App\Models\Programa;
use App\Observers\PersonaleObserver;
use App\Observers\ContactoObserver;
use App\Observers\InscripcioneObserver;
use App\Observers\SeguimientoObserver;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

use function PHPUnit\Framework\isNull;

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

        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator($this->forPage($page, $perPage), $total ?: $this->count(), $perPage, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]);
        });

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $menu_contactos = [
                'text' => 'Lista de contactos',
                'key' => 'list_contacts',
                'label_color' => 'success',
                'route'  => 'admin.contactos.index',
                'icon' => 'fas fa-fw fa-user',
                'can'  =>   'admin.contactos.index'
            ];

            if (auth()->user()->personale && auth()->user()->can(['admin.programas.misprogramas'])) {

                $text_menu_sesion = 'Sesión';
                // session()->put('programa', $inscripciones[0]->programa->id);

                $missesiones = [];
                if (auth()->user()->can(['admin.programas.viewList'])) {
                    foreach (Programa::all() as $programa) {
                        if ($programa->pfj->estado == 1) {
                            array_push($missesiones, [
                                'text'  => $programa->nombre,
                                'url' =>    '/admin/programas/changesession/' . $programa->id,
                                // 'route' => ['admin.users.changesesion', 'programa' => $inscripcione->programa],
                                // 'icon'  => 'fas  fa-users',
                            ]);
                        }
                    }
                } else {
                    $inscripciones = auth()->user()->personale->inscripciones->where('estado', '1');
                    // dd($inscripciones->count());
                    if ($inscripciones->count() != 0) {

                        foreach ($inscripciones as $inscripcione) {
                            if ($inscripcione->programa->pfj->estado == 1) {
                                array_push($missesiones, [
                                    'text'  => $inscripcione->programa->nombre,
                                    'url' =>    '/admin/programas/changesession/' . $inscripcione->programa->id,
                                    // 'route' => ['admin.users.changesesion', 'programa' => $inscripcione->programa],
                                    // 'icon'  => 'fas  fa-users',
                                ]);
                                session(['programa_activo' => $inscripcione->programa->id]);

                            }
                        }
                        
                        // if (count($inscripciones) == 1) {
                        //     session(['programa_activo' => $inscripciones->first()->programa->id]);
                        // }
                    } else {
                        abort(403);
                    }
                }

                if (session('programa_activo')) {
                    $text_menu_sesion = Programa::find(session('programa_activo'))->nombre;
                    //AGREGAR MENUS DE SESION
                    $menu_configuracion = [
                        'text' => 'Mi sesión',
                        'url' => '/admin/programas/' . session('programa_activo') . '/edit',
                        'icon' => 'fas fa-cogs',
                        'can'  =>   'admin.programas.edit'
                    ];

                    $menu_unidades_locales = [
                        'text' => 'Unidades locales',
                        'url' => '/admin/programas/' . session('programa_activo') . '/unidades-locales',
                        'icon' => 'fas fa-cogs',
                        'can'  =>   'admin.programas.unidades-locales'
                    ];

                    $menu_organigrama = [
                        'text' => 'Organigrama',
                        'url' => '/admin/programas/' . session('programa_activo') . '/asignar',
                        'icon' => 'fas fa-sitemap',
                        'can'  =>   'admin.inscripcioneCompanerismos.edit'
                    ];

                    $menu_personales = [
                        'text' => 'Personal',
                        'url' => '/admin/programas/' . session('programa_activo') . '/personal',
                        'icon' => 'fas fa-users',
                        'can'  =>   'admin.programas.edit'
                    ];


                    $menu_anuncios = [
                        'text' => 'Anuncios',
                        'route' => 'admin.anuncios.index',
                        'icon' => 'fas fa-chalkboard-teacher',
                        'can' => 'admin.anuncios.index'
                    ];

                    $menu_asistencias = [
                        'text' => 'Control',
                        'url' => 'admin/programas/' . session('programa_activo'),
                        'icon' => 'fas fa-calendar-check',
                        'can' => 'admin.programas.control'
                    ];

                    $menu_tareas = [
                        'text' => 'Lecturas/Tareas',
                        'url' => 'admin/programas/' . session('programa_activo') . '/tareas',
                        'icon' => 'fas fa-tasks',
                        'can' => 'admin.actividades.index'
                    ];

                    $menu_funciones = [
                        'text' => 'Funciones',
                        'url' => 'admin/programas/' . session('programa_activo') . '/funciones',
                        'icon' => 'fas fa-tasks',
                        'can' => 'admin.funciones.index'
                    ];

                    $menu_dashboard = [
                        'text' => 'Dashboard',
                        'url' => 'admin/programas/' . session('programa_activo') . '/dashboard',
                        'icon' => 'fas fa-chart-line',
                        'can' => 'admin.programas.edit'
                    ];

                    $menu_dashboard_bienvenida = [
                        'text' => 'Dashboard Bienvenida',
                        'url' => 'admin/programas/' . session('programa_activo') . '/dashboard-bienvenida',
                        'icon' => 'fas fa-chart-line',
                        'can' => 'admin.programas.edit'
                    ];

                    /* * */
                    $menu_planificador = [
                        'text' => 'Planificador',
                        'url' => 'admin/programas/' . session('programa_activo') . '/planificador',
                        'icon' => 'fas fa-chart-line',
                        'can' => 'admin.programas.planning'
                    ];
                    $menu_participantes = [
                        'text' => 'Participantes',
                        'url' => 'admin/programas/' . session('programa_activo') . '/participantes',
                        'icon' => 'fas fa-child',
                        'can' => 'admin.programas.participantes'
                    ];

                    $menu_participantes_barrio = [
                        'text' => 'Participantes de mi unidad',
                        'url' => 'admin/programas/' . session('programa_activo') . '/participantes',
                        'icon' => 'fas fa-child',
                        'can' => 'admin.programas.participantes_barrio'
                    ];

                    $menu_companias = [
                        'text' => 'Compañias',
                        'url' => 'admin/programas/' . session('programa_activo') . '/companias',
                        'icon' => 'fas fa-child',
                        'can' => 'admin.programas.companias'
                    ];

                    $menu_habitaciones = [
                        'text' => 'Habitaciones',
                        // 'url' => 'admin/habitaciones',
                        'route' => 'admin.habitaciones.index',
                        'icon' => 'fas fa-hotel',
                        'can' => 'admin.programas.habitaciones'
                    ];

                    $header = [
                        'header' => 'Dashboard',
                        'can'  =>   'admin.programas.edit',
                        'key' => 'dashboard'
                    ];


                    // $event->menu->addAfter('programa', $menu_funciones);
                    // $event->menu->addAfter('programa', $menu_tareas);
                    $event->menu->addAfter('participantes', $menu_unidades_locales);
                    $event->menu->addAfter('participantes', $menu_companias);
                    $event->menu->addAfter('participantes', $menu_participantes_barrio);
                    $event->menu->addAfter('participantes', $menu_participantes);
                    $event->menu->addAfter('programa', $menu_habitaciones);
                    $event->menu->addAfter('programa', $menu_asistencias);
                    $event->menu->addAfter('programa', $menu_anuncios);
                    $event->menu->addAfter('programa', $menu_organigrama);
                    $event->menu->addAfter('programa', $menu_personales);
                    $event->menu->addAfter('programa', $menu_planificador);
                    $event->menu->addAfter('programa', $menu_configuracion);
                    $event->menu->addBefore('programa', $header);
                    $event->menu->addAfter('dashboard', $menu_dashboard);
                    $event->menu->addAfter('dashboard', $menu_dashboard_bienvenida);
                }

                $menu_change_sesion = [
                    'text' => $text_menu_sesion,
                    'topnav' => 'true',
                    'classes' => 'btn btn-red40-pfj',
                    'submenu' => $missesiones
                ];

                $event->menu->addAfter('programa', $menu_change_sesion);
            }
        });


        Personale::observe(PersonaleObserver::class);
        Inscripcione::observe(InscripcioneObserver::class);
        Seguimiento::observe(SeguimientoObserver::class);
        Contacto::observe(ContactoObserver::class);
    }
}
