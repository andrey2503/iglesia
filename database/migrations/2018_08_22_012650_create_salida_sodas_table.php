<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidaSodasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_sodas', function (Blueprint $table) {
          $table->increments('id');
          $table->string('descripcion');
          $table->decimal('monto', 18, 2);
          $table->integer('fk_grupo')->unsigned();
          $table->foreign('fk_grupo')->references('id')->on('administrador_sodas');
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
        Schema::dropIfExists('salida_sodas');
    }
}
