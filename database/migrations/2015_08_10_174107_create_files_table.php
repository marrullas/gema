<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('tarea_id')->unsigned();
            $table->string('mime', 255);
            $table->string('filename', 255);
            $table->bigInteger('size')->unsigned();
            $table->string('storage_path')->unique();
            //$table->string('disk', 10);
            $table->boolean('status');
            $table->integer('user_id')->unsigned(); //quien subio el archivo el dueño
            $table->text('descripcion')->nullable();
            $table->enum('tipo',['evidencia','apoyo','formato','otro'])->default('evidencia');
            $table->timestamps();


            $table->foreign('tarea_id')
                ->references('id')
                ->on('tareas')
                ->onDelete('cascade');
            $table->foreign('user_id')
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
        //
        Schema::drop('files');
    }
}
