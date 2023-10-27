<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarrioInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barrio_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('cupos')->default(0);
            $table->foreignId('barrio_id')->constrained();
            $table->unsignedBigInteger('obispo_id');
            $table->foreign('obispo_id')->references('id')->on('users');
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
        Schema::dropIfExists('barrio_infos');
    }
}
