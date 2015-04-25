<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->boolean('all_day');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('ficha_id')->unsigned();
            $table->text('descripcion')->nullable();
            //$table->integer('detalle_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('ficha_id')
                ->references('id')
                ->on('fichas')
                ->onDelete('cascade');
            /*$table->foreign('detalle_id')
                    ->references('id')
                    ->on('detalles')
                    ->onDelente('cascade');*/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('eventos');
    }

}
