<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_carrito', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cantidad');
            $table->unsignedDouble('precio');
            $table->unsignedBigInteger('carrito_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('carrito_id')->references('id')->on('carrito');
            $table->foreign('producto_id')->references('id')->on('producto');
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
        Schema::dropIfExists('detalle_carrito');
    }
};
