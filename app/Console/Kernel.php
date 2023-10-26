<?php

namespace App\Console;

use App\Models\Image;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            $img_tareas = Storage::files('images-tareas');
            $contactos = Storage::files('contactos');
            $programas = Storage::files('programas');
            $anuncios = Storage::files('anuncios');
            $images = Image::pluck('url')->toArray();
            
            $images  = array_diff($img_tareas, $images);
            $images  = array_diff($contactos, $images);
            $images  = array_diff($programas, $images);
            $images  = array_diff($anuncios, $images);

            Storage::delete($images);

        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
