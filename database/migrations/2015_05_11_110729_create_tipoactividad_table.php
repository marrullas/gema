<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoactividadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipoactividad', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('color',20)->default('#26A0C9');
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
		Schema::drop('tipoactividad');
	}

}
