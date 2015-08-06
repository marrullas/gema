<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasxusuariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareasxusuario', function(Blueprint $table)
        {
            //crear una tabla tareas por usuario? esta tabla debera tener los estados?
            $table->increments('id');
            $table->integer('tarea_id')->unsigned();
            $table->integer('responsable')->nullable(); //llave foranea table usuario
            $table->boolean('colaborador')->default(false); //determina si es colaborador
            $table->dateTime('recordar')->nullable(); //fecha para crear un mensaje de recordatorio            $table->enum('estado',['enviado','publicada','pendiente', 'suspendida']); //es caso de ser procedimiento que paso es
            $table->boolean('hecho')->default(false); //tarea terminada
            $table->boolean('cancelado')->default(false); //solo el creador de la tarea la puede cancelar
            $table->dateTime('termino')->nullable(); //fecha de terminada o cancelada
            $table->boolean('auditado')->default(false);//marca para saber si fue auditada
            $table->integer('auditor')->nullable(); //codigo del usuario que audito
            $table->timestamps();

            $table->foreign('tarea_id')
                ->references('id')
                ->on('tareas')
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

        Schema::drop('tareasxusuario');
    }
}
