<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSeguimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->text('detalles');
            $table->integer('estadoseguimientos')->unsigned();
            $table->dateTime('fecha_entrega')->nullable();
            $table->integer('user_id')->unsigned();//usuario propietario
            $table->integer('user_id_seguimiento')->unsigned()->nullable();//usuario del seguimiento
            $table->boolean('visible')->default(false); //
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('user_id_seguimiento')
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
        Schema::drop('seguimientos');
    }
}
