<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHorasEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos', function(Blueprint $table)
		{
			//
            $table->integer('horas')->after('end')->default(1);
            $table->boolean('is_task')->after('horas')->default(false);
            //$table->integer('ficha_id')->unsigned()->nullable()->change();
            $table->string('actividad')->after('title');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventos', function(Blueprint $table)
		{
			//
            $table->dropColumn('horas');
            $table->dropColumn('is_task');
		});
	}

}
