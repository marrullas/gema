<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ies', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre');
            $table->string('ciudad');
            $table->string('dirección')->nullable();
            $table->string('telefono');
            $table->string('mapa')->nullable();
            $table->text('detalles')->nullable(); //nombre rector, coordinador, docente tecnico, telefons de C/U
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ies');
	}

}
