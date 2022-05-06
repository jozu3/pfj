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
