<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        //Schema::drop('tareas');
        Schema::create('tareas', function(Blueprint $table)
        {

            //crear una tabla tareas por usuario? esta tabla debera tener los estados?
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->dateTime('entrega')->nullable(); //fecha limite
            $table->dateTime('envio')->nullable(); //fecha de envio de la tarea para programar tareas
            $table->boolean('activo')->default(true); //determina si esta activo o inactivo
            $table->enum('prioridad',['normal','baja','alta']); //cual es la prioridad de la tarea
            $table->integer('creador')->nullable(); //llave foranea table usuario
            $table->integer('lista')->unsigned(); //codigo lista de tareas a la que pertenece la tarea
            $table->integer('orden')->default(1); //es caso de ser procedimiento que paso es
            $table->enum('ambito',['centro','ie','programa','ficha','aprendiz'])->nullable(); //es caso de ser procedimiento que paso es
            $table->boolean('dependiente')->default(false);//indica si este paso depende de uno anterior
            $table->boolean('vigente')->default(true);
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
        //
       Schema::drop('tareas');

    }
}
