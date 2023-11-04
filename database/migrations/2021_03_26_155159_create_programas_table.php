<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pfj_id')->constrained();
            $table->string('nombre');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->tinyInteger('estado');
            $table->boolean('mostrarGrupos')->nullable();
            $table->boolean('mostrarGruposToCoordAuxiliares')->nullable()->default(1);
            $table->longText('resena_matrimonio')->nullable();
            $table->longText('resena_matrimonio_logistica')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programas');
    }
}
