<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientoncsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientoncs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ncs_id')->unsigned();
            $table->integer('user_id')->unsigned(); //usuaario que crea
            /*se detalla el movimiento
                Ej:
                Auditor abre nc - fecha:hora
                Usuario cambio estado a devuelto - fecha hora
                Auditor cambio estado a Abriero - FEcha:hora
                Auditor cambio estado a Cerrado - Fecha:hora
            */
            $table->text('detalle'); //descrpcion movimiento
            $table->timestamps();
            $table->foreign('ncs_id')
                ->references('id')
                ->on('ncs')
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
        Schema::drop('seguimientoncs');
    }
}
