<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('procedimiento_id')->unsigned();//llave table procedimiento
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->text('responsable')->nullable(); //texto con la descripcion de los responsables
            $table->boolean('obligatorio')->default(false); //determina si la actividad es obligatoria
            $table->smallInteger('orden')->default(1);//orden de la actividad dentro del procedimiento
            $table->boolean('condicional')->default(false); //esta actividad es obligatoria dentro del procedimiento
            $table->boolean('aprobo')->default(true); //en caso de ser condicionante si aprobo o no
            $table->integer('actividad_siguiente')->nullable();//numero orden que continua
            $table->timestamps();

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
        Schema::drop('actividades');
    }
}
