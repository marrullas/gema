<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entrega_id')->unsigned();
            $table->integer('actividad_id')->unsigned();
            $table->boolean('hecho')->default(false);//marca del usuario responsable en caso de subir evidencia
            //marca la evidencia como aceptada. Una vez revisado no se permite eliminar
            $table->boolean('revisado')->default(false);
            $table->integer('revisor')->unsigned()->nullable();//codigo usuario que reviso
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
        Schema::drop('evidencias');
    }
}
