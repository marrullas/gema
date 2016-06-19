<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuariosxciclo extends Migration
{
    /**
     * Run the migrations.
     * Esta tabla registra los usuarios y los ciclos de auditoria
     * @return void
     */
    public function up()
    {
        Schema::create('usuariosxciclo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); //usuario a auditar
            $table->integer('ciclo_id')->unsigned();
            $table->boolean('disponible')->default(true); //si esta disponible para auditar
            $table->boolean('autogestion')->default(false);
            $table->boolean('iniciado')->default(false);
            $table->boolean('finalizado')->default(false);
            $table->text('descripcion')->nullable();
            $table->date('fechaini')->nullable(); //fecha de inicio
            $table->date('fechafin')->nullable(); //fecha de terminación
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('ciclo_id')
                ->references('id')
                ->on('ciclos')
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
        Schema::drop('usuariosxciclo');
    }
}
