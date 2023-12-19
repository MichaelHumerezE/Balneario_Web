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
        Schema::create('pago', function (Blueprint $table) {
            $table->id();
            $table->string('imagen')->nullable();
            $table->string('url')->nullable();
            $table->unsignedDouble('monto_total')->nullable();
            $table->dateTime('fecha_hora');
            $table->unsignedSmallInteger('estado');
            $table->string('tipo');
            $table->unsignedBigInteger('nota_venta_id');
            $table->foreign('nota_venta_id')->references('id')->on('nota_venta');
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
        Schema::dropIfExists('pago');
    }
};
