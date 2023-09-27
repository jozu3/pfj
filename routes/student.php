<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\ProgramaController;
use App\Http\Controllers\Student\GrupoController;
use App\Http\Controllers\Student\ParticipanteController;
use App\Http\Controllers\Student\TareaController;

Route::resource('', HomeController::class)->names('st');
Route::resource('programas', ProgramaController::class)->names('st.programas');
Route::get('programas/{programa}/inscripciones', [ProgramaController::class, 'inscripciones'])->name('st.programas.inscripciones');
Route::resource('grupos', GrupoController::class)->names('st.grupos');
Route::get('programas/{programa}/mislecturas', [TareaController::class, 'mislecturas'])->name('st.tareas.mislecturas');
Route::resource('tareas', TareaController::class)->names('st.tareas');
Route::get('participante/compania/{companerismo}', [ParticipanteController::class, 'compania'])->name('st.participante.compania');
Route::resource('participantes', ParticipanteController::class)->names('st.participantes');
//Route::get('participantes/{programa}/mislecturas', [ParticipanteController::class, 'registro'])->name('st.participantes.registro');