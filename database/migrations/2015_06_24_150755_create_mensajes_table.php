<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('conversacion'); //codigo para segumiento de respuestas
            $table->string('titulo');
            $table->text('contenido');
            $table->enum('status',['borrador','enviado','leido','oculto'])->default('enviado');
            $table->boolean('sendmail')->default(false); //si se envio correo electronico
            $table->boolean('tarea')->default(false); //marca que sea un mensaje sobre una tarea
            $table->integer('user_id')->unsigned(); //remitente que envia el mensaje
            $table->integer('destinatario'); ///codigo del usuario destinatario
            $table->text('destinatarios')->nullable(); ///lista user_id de usuarios a los que se envio el mensaje(1|40|17)
            $table->dateTime('enviar')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('respuesta')->default(false); //valida si el mensaje es un respuesta a un mensaje
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
        Schema::drop('mensajes');
    }
}
