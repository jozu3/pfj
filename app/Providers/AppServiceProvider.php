<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Personale;
use App\Models\Contacto;
use App\Models\Inscripcione;
use App\Models\Seguimiento;
use App\Models\Obligacione;
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

            if (auth()->user()->hasRole(['Admin', 'Asistente', 'Vendedor'])) {
                   
                //$nuevos = Contacto::whereIn('estado', [1,2,3,4])->where('newassign', '1')->where('personal_id', auth()->user()->personal->id)->count();
                $nuevos = 0;
                if ($nuevos > 0) {
                    $menu_contactos['label'] = $nuevos;
                }

            }   
            $event->menu->addAfter('ventas', $menu_contactos);

            if(auth()->user()->personale){
                $inscripciones = auth()->user()->personale->inscripciones;
                // session()->put('programa', $inscripciones[0]->programa->id);

                $missesiones = [];
                
                foreach ($inscripciones as $inscripcione) {
                    array_push($missesiones, [
                        'text'  => $inscripcione->programa->nombre,
                        'url' =>    '/admin/users/changesession/'.$inscripcione->programa->id,
                        // 'route' => ['admin.users.changesesion', 'programa' => $inscripcione->programa],
                        // 'icon'  => 'fas  fa-users',
                    ]);
                }
                
                $menu_change_sesion = [
                    'text' => 'Sesión',
                    'topnav' => 'true',
                    'url'  => 'admin/blog/new',
                    'classes' => 'btn btn-yellow-pfj',
                    'submenu' => $missesiones
                ];
                
                
                
                $event->menu->addAfter('programa', $menu_change_sesion);

                //AGREGAR MENUS DE SESION
                $menu_organigrama = [
                    'text' => 'Organigrama',
                    'url' => '/admin/programas/'.session('programa').'/asignar',
                    // 'route'  => ['admin.programas.asignar', $programa_activo],
                    'icon' => 'fas fa-sitemap',
                    'can'  =>   'admin.contactos.index'
                ];
                
                $event->menu->addAfter('programa', $menu_organigrama);

            }




        });


        Personale::observe(PersonaleObserver::class);
        Inscripcione::observe(InscripcioneObserver::class);
        Seguimiento::observe(SeguimientoObserver::class);
        Contacto::observe(ContactoObserver::class);
        Obligacione::observe(ObligacioneObserver::class);
    }
}
