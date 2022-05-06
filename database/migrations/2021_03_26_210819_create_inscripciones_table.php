<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personale_id')->constrained();
            $table->foreignId('programa_id')->constrained();
            $table->foreignId('role_id')->constrained();
            $table->tinyInteger('estado');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /*
        asignacion: role_id

        2 -> Matrimonio Director
        3 -> Matrimonio logistica
        4 -> Cordinador
        5 -> Cordinador auxiliar
        6 -> Consejero
    
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripciones');
    }
}
