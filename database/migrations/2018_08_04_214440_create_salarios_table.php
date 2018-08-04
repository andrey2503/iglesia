<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('moneda');
            $table->string('salarioNominal');
            $table->string('obligaciones');
            $table->string('salarioNeto');//salario nominal - obligaaciones
            $table->integer('fk_puesto')->unsigned();
            $table->foreign('fk_puesto')->references('id')->on('puestos');
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
        Schema::dropIfExists('salarios');
    }
}
