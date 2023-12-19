<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

date_default_timezone_set('America/La_Paz');

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('estado');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('users');
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
        Schema::dropIfExists('carrito');
    }
};
