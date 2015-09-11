<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocsapoyoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docsapoyo', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('tarea_id')->unsigned();
            $table->string('mime', 255);
            $table->string('filename', 255);
            $table->bigInteger('size')->unsigned();
            $table->string('storage_path')->unique();
            //$table->string('disk', 10);
            $table->boolean('status');
            $table->integer('user_id')->unsigned(); //quien subio el archivo el dueño
            $table->text('descripcion')->nullable();
            $table->integer('tipodocumento_id')->unsigned();
            $table->timestamps();


            $table->foreign('tipodocumento_id')
                ->references('id')
                ->on('tipodocumento')
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
        Schema::drop('docsapoyo');
    }
}
