<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ContactoController;
use App\Http\Controllers\Admin\SeguimientoController;
use App\Http\Controllers\Admin\PersonaleController;
use App\Http\Controllers\Admin\PfjController;
use App\Http\Controllers\Admin\GrupoController;
use App\Http\Controllers\Admin\NotaController;
use App\Http\Controllers\Admin\ProgramaController;
use App\Http\Controllers\Admin\InscripcioneController;
use App\Http\Controllers\Admin\ObligacioneController;
use App\Http\Controllers\Admin\PagoController;
use App\Http\Controllers\Admin\CuentaController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\CapacitacioneController;
use App\Http\Controllers\Admin\InscripcioneCompanerismoController;
use App\Http\Controllers\Admin\ExcelController;
use App\Http\Controllers\Admin\CompanerismoController;
use App\Http\Controllers\Admin\AnuncioController;
use App\Http\Controllers\Admin\BarrioController;
use App\Http\Controllers\Admin\FuncioneController;
use App\Http\Controllers\Admin\MaterialeController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\EstacaController;

Route::resource('', HomeController::class)->names('admin');

Route::get('/users/sessions', [UserController::class, 'listSessions'])->name('admin.users.sessions');
Route::resource('users', UserController::class)->names('admin.users');
Route::resource('personales', PersonaleController::class)->names('admin.personales');
Route::resource('roles', RoleController::class)->names('admin.roles');
Route::resource('estacas', EstacaController::class)->names('admin.estacas');
Route::resource('barrios', BarrioController::class)->names('admin.barrios');
Route::get('/estacas/{estaca}/barrios', [BarrioController::class, 'show'])->name('admin.barrios.show');
Route::resource('contactos', ContactoController::class)->names('admin.contactos');
Route::resource('seguimientos', SeguimientoController::class)->names('admin.seguimientos');
Route::resource('pfjs', PfjController::class)->names('admin.pfjs');
Route::get('grupos/migrupo', [GrupoController::class, 'migrupo'])->name('admin.grupos.migrupo');
Route::resource('grupos', GrupoController::class)->names('admin.grupos');
Route::resource('companerismos', CompanerismoController::class)->names('admin.companerismos');
Route::resource('anuncios', AnuncioController::class)->names('admin.anuncios');
Route::resource('notas', NotaController::class)->names('admin.notas');
Route::get('/programas/changesession/{programa}', [ProgramaController::class, 'changeSession'])->name('admin.programas.changesesion');
Route::get('/programas/misprogramas', [ProgramaController::class, 'misprogramas'])->name('admin.programas.misprogramas');
Route::get('/programas/grupos', [ProgramaController::class, 'grupos'])->name('admin.programas.grupos');
Route::get('/programas/{programa}/planificador', [ProgramaController::class, 'planificador'])->name('admin.programas.planificador');
Route::get('/programas/{programa}/asignar', [ProgramaController::class, 'asignar'])->name('admin.programas.asignar');
Route::get('/programas/{programa}/directorio', [ProgramaController::class, 'directorio'])->name('admin.programa.directorio');
Route::get('/programas/{programa}/personal', [ProgramaController::class, 'personal'])->name('admin.programas.personal');
Route::get('/programas/{programa}/dashboard', [ProgramaController::class, 'dashboard'])->name('admin.programas.dashboard');
Route::get('/programas/{programa}/tareas', [ProgramaController::class, 'tareas'])->name('admin.programas.tareas');
Route::get('/programas/{programa}/funciones', [ProgramaController::class, 'funciones'])->name('admin.programas.funciones');
Route::resource('programas', ProgramaController::class)->names('admin.programas');
Route::resource('capacitaciones', CapacitacioneController::class)->names('admin.capacitaciones');

Route::get('/inscripciones/notificacion/{inscripcione}', [InscripcioneController::class, 'notificacion'])->name('admin.inscripciones.notificacion');
Route::resource('inscripciones', InscripcioneController::class)->names('admin.inscripciones');
Route::resource('obligaciones', ObligacioneController::class)->names('admin.obligaciones');
Route::resource('pagos', PagoController::class)->names('admin.pagos');
Route::resource('cuentas', CuentaController::class)->names('admin.cuentas');
Route::post('inscripcione_companerismos/deleteInscripcioneCompanerismo', [InscripcioneCompanerismoController::class, 'deleteInscripcioneCompanerismo'])->name('admin.inscripcione_companerismos.deleteInscripcioneCompanerismo');
Route::post('inscripcione_companerismos/updateInscripcione/{inscripcione}', [InscripcioneCompanerismoController::class, 'updateInscripcione'])->name('admin.inscripcione_companerismos.updateInscripcione');
Route::resource('inscripcione_companerismos', InscripcioneCompanerismoController::class)->names('admin.inscripcione_companerismos');
Route::get('reportes', [ReporteController::class, 'index'])->name('admin.reportes.index');



Route::delete('capacitaciones/destroyfromgroup/{grupo}', [CapacitacioneController::class, 'destroyfromgroup'])->name('admin.capacitaciones.destroyfromgroup');
Route::post('capacitaciones/storeforgroup/{grupo}', [CapacitacioneController::class, 'storeforgroup'])->name('admin.capacitaciones.storeforgroup');


  

//Route::resource('pdfs', PDFController::class)->names('pdfs');
Route::get('recibo-inscripcione/{idinscripcione}', [PDFController::class, 'reciboInscripcione'])->name('admin.print');
Route::get('reportpagos', [PDFController::class, 'pagos'])->name('admin.print.pagos');

Route::get('/export-excel-personal/{programa}/{familia}/{estaca}/{estado}/{rol}', [ExcelController::class, 'exportExcelPersonal'])->name('admin.excel.exportExcelPersonal');
Route::post('/import-excel-personal/{programa}', [ExcelController::class, 'importExcelPersonal'])->name('admin.excel.importExcelPersonal');

Route::resource('materiales', MaterialeController::class)->names('admin.materiales');

	
