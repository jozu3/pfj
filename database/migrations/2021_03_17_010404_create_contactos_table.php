<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos')->nullable();
            $table->string('telefono')->nullable();
            $table->date('fecnac')->nullable();
            $table->string('email')->nullable();
            $table->string('doc')->nullable();
            $table->string('obispo')->nullable();
            $table->string('fotodrive')->nullable();
            $table->string('telobispo')->nullable();
            $table->string('anterior')->nullable();
            $table->longText('pasatiempos')->nullable();
            $table->longText('experiencia')->nullable();
            $table->tinyInteger('paciencia')->default(0)->nullable();
            $table->tinyInteger('liderazgo')->default(0)->nullable();
            $table->tinyInteger('ensenanza')->default(0)->nullable();
            $table->tinyInteger('estado');
            $table->string('genero');
            $table->tinyInteger('mretornado')->default(0);
            $table->tinyInteger('newassign')->default(1);
            
            $table->tinyInteger('primeros_auxilios')->default(0);
            $table->string('email_obispo')->nullable();
            $table->foreignId('barrio_id')->default(1);
            $table->string('otro_barrio')->nullable();
            $table->string('otra_estaca')->nullable();
            $table->string('mision')->nullable();
            $table->string('estudios')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('llamamiento')->nullable();
            $table->string('instituto')->nullable();
            $table->string('mes_recomendacion')->nullable();
            $table->string('anio_recomendacion')->nullable();

            $table->longText('informacion_medica')->nullable();
            $table->string('talla')->nullable();
            $table->longText('informacion_alimentaria')->nullable();
            $table->string('contacto1')->nullable();
            $table->string('contacto1_phone')->nullable();
            $table->string('contacto1_email')->nullable();
            $table->string('contacto2')->nullable();
            $table->string('contacto2_phone')->nullable();
            $table->string('contacto2_email')->nullable();
            $table->integer('age')->nullable();
            $table->integer('age_aniopfj')->nullable();
            $table->tinyInteger('estado_aprobacion')->nullable();
            $table->string('sangre')->nullable();
            $table->longText('alergia')->nullable();
            $table->longText('tratamiento_medico')->nullable();
            $table->longText('diabetico_asmatico')->nullable();
            $table->string('seguro_medico')->nullable();
            $table->boolean('vacunas')->nullable();

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
        Schema::dropIfExists('contactos');
    }
}
