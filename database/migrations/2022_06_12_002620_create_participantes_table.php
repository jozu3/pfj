<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('documento')->nullable();
            $table->date('fecnac');
            $table->boolean('genero');
            $table->string('telefono');
            $table->string('email');
            $table->string('informacion_medica');
            $table->string('talla');
            $table->string('informacion_alimentaria');
            $table->string('contacto1')->nullable();
            $table->string('contacto1_phone')->nullable();
            $table->string('contacto1_email')->nullable();
            $table->string('contacto2')->nullable();
            $table->string('contacto2_phone')->nullable();
            $table->string('contacto2_email')->nullable();
            $table->integer('age');
            $table->integer('age_2022');
            $table->foreignId('barrio_id')->constrained();
            $table->tinyInteger('estado_aprobacion');
            $table->string('obispo');
            $table->string('obispo_email');
            $table->string('sangre');
            $table->string('alergia');
            $table->string('tratamiento_medico');
            $table->string('diabetico_asmatico');
            $table->string('seguro_medico');
            $table->boolean('vacunas');

            $table->foreignId('programa_id')->constrained();
            $table->tinyInteger('estado');
            $table->tinyInteger('tipo_ingreso')->nullable();
            $table->dateTime('horallegada')->nullable();
            
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
        Schema::dropIfExists('participantes');
    }
}
