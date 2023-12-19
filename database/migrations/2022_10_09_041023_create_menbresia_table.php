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
        Schema::create('menbresia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->double('precio');
            $table->string('imagen')->nullable();
            $table->string('url')->nullable();
            $table->unsignedInteger('periodo');
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
        Schema::dropIfExists('menbresia');
    }
};
