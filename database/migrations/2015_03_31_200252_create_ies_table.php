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
            $table->string('nit')->nullable();
            $table->enum('tipo',['publica','privada'])->default('publica');
            $table->enum('modalidad',['tecnica','academica'])->default('tecnica');
            $table->text('email')->nullable();
            $table->string('ciudad_id');
            $table->string('direccion')->nullable();
            $table->string('telefono');
            $table->string('nombre_rector')->nullable();
            $table->string('email_rector')->nullable();
            $table->string('tel_rector')->nullable();
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
