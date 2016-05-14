<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstadosSeguimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadoseguimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->boolean('positivo')->nullable(); //determina si el estado del seguimiento es positivo o negativo
            $table->string('icono')->default('fa-thumbs-o-up');
            $table->string('color')->default('#5cb85c');
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
        Schema::drop('estadoseguimientos');
    }
}
