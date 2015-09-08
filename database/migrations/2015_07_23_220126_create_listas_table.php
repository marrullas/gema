<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion')->nullable(); //agrego el campo pero inicialmente no lo voy a solicitar para crear
            $table->boolean('es_procedimiento')->default(false);
            $table->integer('user_id')->unsigned();//llave foranea de la tabla usuario
            $table->boolean('activo')->default(true);
            $table->date('vencimiento')->nullable(); //fecha de vencimiento
            $table->timestamps();
        });

        Schema::table('tareas', function(Blueprint $table)
        {
            //
            $table->foreign('lista')
                ->references('id')
                ->on('listas')
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
        Schema::table('tareas',function(Blueprint $table)
        {
           $table->dropForeign('tareas_lista_foreign');
        });
        Schema::drop('listas');
    }
}
