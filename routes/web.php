<?php

use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Notifications\InscripcioneNotification;
use App\Models\User;
use App\Models\Inscripcione;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
    //return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::get('/notification', function () {
//     $user = User::find(2);
//     $inscripcione = Inscripcione::find(1);
//     $user->notify(new InscripcioneNotification($inscripcione));
//     return 'asdsad';
// });

Route::get('consejeros/preinscripcion', [HomeController::class, 'preinscripcione'])->name('public.pre-inscripcione');
Route::post('consejeros/preinscripcionstore', [HomeController::class, 'contactoStore'])->name('public.pre-inscripcione.contacto-store');

Route::get('/limanorte', function(){

    if (date("Y-m-d H:i:s") >= "2023-12-03 17:00:00" ) {
        return redirect('https://www.churchofjesuschrist.org/youth/childrenandyouth/fsy/session?id=a9bdd131-938b-468e-954b-7dd819e01f0e&lang=spa');
    }
    return view('public.inscripciones');
    
});