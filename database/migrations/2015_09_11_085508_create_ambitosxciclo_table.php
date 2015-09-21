<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbitosxcicloTable extends Migration
{
    /**
     * Run the migrations.
     * Esta es la tabla pivot entre los ciclos y las entidades que se deben operar y controlar
     * las entidades son fichas, instituciones educativas, empresas, areas (articulación, titulada)
     * @return void
     */
    public function up()
    {
        Schema::create('ambitosxciclo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciclo_id')->unsigned();
            $table->integer('ambito_id')->unsigned();
            $table->integer('entidad_id')->unsigned();//codigo de la ficha, IE, empresa, etc
            $table->boolean('activo')->default(true);
            $table->integer('user_id')->unsigned()->nullable(); //usuario responsable
            $table->unique(['ciclo_id','entidad_id'],'ciclo_entidad_key');
            $table->timestamps();
            $table->foreign('ciclo_id')
                ->references('id')
                ->on('ciclos')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ambitosxciclo');
    }
}
