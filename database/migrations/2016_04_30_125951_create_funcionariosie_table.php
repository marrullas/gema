<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionariosie', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('correo');
            $table->text('observaciones');
            $table->integer('ie_id')->unsigned();
            $table->integer('tipofuncionario_id')->unsigned();
            $table->timestamps();

            $table->foreign('ie_id')
                ->references('id')
                ->on('ies');
            $table->foreign('tipofuncionario_id')
                ->references('id')
                ->on('tipofuncionario');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('funcionariosie');
    }
}
