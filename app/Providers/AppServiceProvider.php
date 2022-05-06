<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Personale;
use App\Models\Contacto;
use App\Models\Inscripcione;
use App\Models\Pago;
use App\Models\Seguimiento;
use App\Models\Obligacione;
use App\Observers\PersonaleObserver;
use App\Observers\PersonaleNotaObserver;
use App\Observers\ContactoObserver;
use App\Observers\InscripcioneObserver;
use App\Observers\PagoObserver;
use App\Observers\SeguimientoObserver;
use App\Observers\UnidadObserver;
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


        });


        Pago::observe(PagoObserver::class);
        Personale::observe(PersonaleObserver::class);
        Inscripcione::observe(InscripcioneObserver::class);
        Seguimiento::observe(SeguimientoObserver::class);
        Contacto::observe(ContactoObserver::class);
        Obligacione::observe(ObligacioneObserver::class);
    }
}
