<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCiclosTable extends Migration
{
    /**
     * Run the migrations.
     * son las interaciones operativas donde se aplicar procedimientos sobre ambitos
     * esta tabla determina que se opera y por consiguiente que se controla
     * @return void
     */
    public function up()
    {
        Schema::create('ciclos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->integer('ambito_id')->unsigned();
            $table->integer('procedimiento_id')->unsigned();
            $table->date('fecha_ini');
            $table->date('fecha_fin')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->foreign('ambito_id')
                ->references('id')
                ->on('ambitos')
                ->onDelete('cascade');
            $table->foreign('procedimiento_id')
                ->references('id')
                ->on('procedimientos')
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
        Schema::drop('ciclos');
    }
}
