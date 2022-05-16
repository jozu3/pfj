<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaleVacunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personale_vacunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personale_id')->constrained();
            $table->foreignId('vacuna_id')->constrained();
            $table->tinyInteger('vacunado');
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
        Schema::dropIfExists('personale_vacunas');
    }
}
