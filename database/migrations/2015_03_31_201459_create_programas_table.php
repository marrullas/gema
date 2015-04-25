<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre');
            $table->string('codigo');
            $table->string('version');
            $table->string('linea')->nullable();
            $table->string('red')->nullable();
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
		Schema::drop('programas');
	}

}
