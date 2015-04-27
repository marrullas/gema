<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColTipoIesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('ies',function($table)
        {
            $table->enum ('tipo',['privada','publica'])->default('publica')->after('detalles');
            $table->enum('modalidad',['tecnico','academico'])->after('tipo'); //determina si la IE cuenta con resolución tecnica
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//

        Schema::table('ies', function($table) {

            $table->dropColumn('tipo');
            $table->dropColumn('modalidad');


        });
	}

}
