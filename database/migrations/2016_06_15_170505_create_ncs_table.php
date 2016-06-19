<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auditoria_id')->unsigned(); //usuario responsable, si esta vacio es una nc suelta
            $table->integer('user_id')->unsigned(); //usuario responsable
            $table->integer('auditor')->unsigned(); // usuario que abre la nc auditor
            $table->integer('certificador')->unsigned(); // usuario que cierra la nc, por defecto el mismo auditor
            $table->integer('estadoncs_id')->unsigned(); //estado de la NC
            $table->text('descripcion');// descripcion del Hallazgo
            $table->text('explicacion')->nullable();// descripcion del Hallazgo
            $table->integer('tiposnc_id')->unsigned(); //tipo de no conformidad y accion a tomar
            $table->text('medida');// descripcion de la propuesta de mejora
            $table->date('plazo')->nullable(); //Plazo para ser resuelta
            $table->timestamps();
            $table->foreign('auditoria_id')
                ->references('id')
                ->on('auditoria')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('certificador')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('auditor')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('estadoncs_id')
                ->references('id')
                ->on('estadoncs')
                ->onDelete('cascade');
            $table->foreign('tiposnc_id')
                ->references('id')
                ->on('tiposnc')
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
        Schema::drop('ncs');
    }
}
