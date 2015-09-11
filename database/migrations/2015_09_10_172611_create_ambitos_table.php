<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambitos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('tabla'); //nombre de la tabla (fichas, IE, areasprocesos, empresa
            $table->string('tabla_id');//nombre del campo en la table que almacena el codigo
            $table->string('tabla_nombre');//nombre del campo que almacena el nombre del objeto
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
        Schema::drop('ambitos');
    }
}
