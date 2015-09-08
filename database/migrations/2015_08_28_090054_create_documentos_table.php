<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre'); //por defecto sera el nombre del archivo
            $table->text('descripcion')->nullable();
            $table->integer('procedimiento_id')->unsigned();//llave table procedimiento
            $table->integer('actividad_id')->unsigned();//llave table actividades
            $table->integer('tipo')->unsigned(); //llave foranea tipo_docuentos (apoyo, registro/evidencia, formato)
            $table->enum('retencion',['fisico','digital','mixto'])->default('digital');
            $table->string('formato')->nullable(); //formato/documento para descargar
            $table->timestamps();
            $table->foreign('procedimiento_id')
                ->references('id')
                ->on('procedimientos')
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
        Schema::drop('documentos');
    }
}
