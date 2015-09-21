<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbitosTable extends Migration
{
    /**
     * Run the migrations.
     * Almacena los lugares donde se aplican la operacion y los procedimientos
     * para el caso SENA seria sobre las fichas, programas, empresa, instituciones educaticas, areas
     * @return void
     */
    public function up()
    {
        Schema::create('ambitos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('nombre_tabla'); //nombre de la tabla (fichas, IE, areasprocesos, empresa
            $table->string('campo_id');//nombre del campo en la table que almacena el codigo
            $table->string('campo_user');//nombre del campo en la table que almacena el codigo del usuario responsable
            $table->string('campo_nombre');//nombre del campo que almacena el nombre del objeto
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
