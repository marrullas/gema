<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('version')->nullable();
            $table->string('codigo')->nullable();
            $table->date('vigencia')->nullable();
            $table->string('proceso')->nullable();
            $table->string('nombre')->unique();
            $table->text('objetivo')->nullable();
            $table->text('responsable')->nullable();
            $table->text('alcance')->nullable();
            $table->text('generalidades')->nullable();
            $table->string('archivo')->nullable();//archivo descripción del procedimiento
            $table->integer('user_id')->unsigned(); //usuario que crea
            $table->timestamps();
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
        Schema::drop('procedimientos');
    }
}
