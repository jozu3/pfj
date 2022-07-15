<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdadRangosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edad_rangos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('edadmin');
            $table->tinyInteger('edadmax');
            $table->double('razon', 8, 2)->nullable();
            $table->smallInteger('cantcompanias')->nullable();
            $table->smallInteger('cantparticipantes')->nullable();
            $table->foreignId('programa_id')->constrained();
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
        Schema::dropIfExists('edad_rangos');
    }
}
