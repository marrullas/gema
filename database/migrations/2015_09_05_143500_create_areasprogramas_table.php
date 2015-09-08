<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasprogramasTable extends Migration
{
    /**
     * Run the migrations.
     *almacena las areas o programas de la organizacion, empresa o centro
     * @return void
     */
    public function up()
    {
        Schema::create('areasprogramas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();//a que empresa esta relacionada
            $table->timestamps();
            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas')
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
        Schema::drop('areasprogramas');
    }
}
