<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permutas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participante_id')->constrained();
            $table->unsignedBigInteger('permutado_id');
            $table->foreign('permutado_id')->references('id')->on('participantes');
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
        Schema::dropIfExists('permutas');
    }
}
