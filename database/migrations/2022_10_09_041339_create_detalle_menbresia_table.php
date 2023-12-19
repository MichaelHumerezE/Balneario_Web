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
        Schema::create('detalle_menbresia', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cantidad');
            $table->unsignedDouble('precio');
            $table->unsignedBigInteger('menbresia_id');
            $table->unsignedBigInteger('nota_venta_id');
            $table->foreign('menbresia_id')->references('id')->on('menbresia');
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
        Schema::dropIfExists('detalle_menbresia');
    }
};
