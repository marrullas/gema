<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prefijo')->nullable();
            $table->integer('evento_id')->unsigned()->nullable();//llave foranea tabla eventos
            $table->integer('user_id')->unsigned();//llave foranea table usuarios
            $table->string('archivo')->nullable();//almacena el path del archivo del acta
            $table->string('archivo_nombre')->nullable();//nombre del archivo
            $table->string('archivo_ext')->nullable();//extension del archivo
            $table->date('fecha_archivo')->nullable();//fecha de subida del archivo del acta
            $table->text('justificacion')->nullable();//en caso de solicitar una acta sin evento(huerfana)
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('evento_id')
                ->references('id')
                ->on('eventos')
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
        //
        Schema::drop('actas');
    }
}
