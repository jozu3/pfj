<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanerismosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companerismos', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->nullable();
            $table->string('nombre')->nullable();
            $table->foreignId('role_id')->constrained();
            $table->foreignId('grupo_id')->constrained();
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
        Schema::dropIfExists('companerismos');
    }
}
