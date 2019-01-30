<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mov_salidas', function (Blueprint $table) {
          $table->increments('id');
          $table->decimal('monto', 18, 2);
          $table->string('moneda');
          $table->date('fechaRegistro');
          $table->integer('fk_rubro')->unsigned();
          $table->foreign('fk_rubro')->references('id')->on('rubros');
          $table->integer('fk_cuenta')->unsigned();
          $table->foreign('fk_cuenta')->references('id')->on('cuenta_bancarias');
          $table->integer('fk_usuario')->unsigned();
          $table->foreign('fk_usuario')->references('id')->on('usuarios');
          $table->integer('fk_salida')->unsigned();
          $table->foreign('fk_salida')->references('id')->on('salidas');
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
        Schema::dropIfExists('mov_salidas');
    }
}
