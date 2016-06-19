<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuariosxciclo_id')->unsigned(); //usuarios x ciclo de auditoria
            $table->integer('actividad_id')->unsigned(); //codigo de actividad sobre la que hace la Auditoria
            $table->boolean('certificado')->default(false);
            $table->integer('certificador')->unsigned()->nullable(); // usuario que certifica la actividad
            $table->text('detalles')->nullable();
            $table->string('evidencia')->nullable(); //path a un archivo de evidencia, inhabilitado por ahora
            $table->timestamps();
            $table->foreign('usuariosxciclo_id')
                ->references('id')
                ->on('usuariosxciclo')
                ->onDelete('cascade');
            $table->foreign('actividad_id')
                ->references('id')
                ->on('actividades')
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
        Schema::drop('auditoria');
    }
}
