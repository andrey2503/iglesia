<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaPagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta_pagars', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre');
          $table->string('moneda');
          $table->decimal('monto', 18, 2);
          $table->date('fechaRegistro');
          $table->integer('fk_rubro')->unsigned();
          $table->foreign('fk_rubro')->references('id')->on('rubros');
          $table->rememberToken();
          $table->softDeletes();
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
        Schema::dropIfExists('cuenta_pagars');
    }
}
