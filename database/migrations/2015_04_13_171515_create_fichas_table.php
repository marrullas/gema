<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('codigo')->unique();
            $table->date('fecha_ini');
            $table->date('fecha_fin')->nullable();
            $table->integer('user_id')->unsigned();
            $table->enum('estado',['activa','inactiva'])->default('activa');
            $table->integer('ie_id')->unsigned(); //llave con la tabla ies (instituciones educativas)
            $table->integer('programa_id')->unsigned(); //llave con la tabla ies (programa de formacion)
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('programa_id')
                ->references('id')
                ->on('programas');


            $table->foreign('ie_id')
                ->references('id')
                ->on('ies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fichas');
    }

}
