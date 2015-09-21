<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEntregas extends Migration
{
    /**
     * Run the migrations.
     *Esta tabla se llena automaticamente cuando se active un ciclo
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actividad_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            //$table->integer('user_id')->unsigned();
            $table->date('fecha')->nullable();
            $table->text('descripcion')->nullable(); //descripcion de la entrega en caso de requerir
            $table->integer('numeroarchivos')->default(1);//numero archivos que debe tener las evidencias
            $table->integer('documento_id')->unsigned()->nullable(); //documento(tabla) que se espera como evidencia
            $table->timestamps();
            $table->foreign('ciclo_id')
                ->references('id')
                ->on('ciclos')
                ->onDelete('cascade');
            $table->foreign('actividad_id')
                ->references('id')
                ->on('actividades')
                ->onDelete('cascade');
            $table->foreign('documento_id')
                ->references('id')
                ->on('documentos')
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
        Schema::drop('entregas');
    }
}
