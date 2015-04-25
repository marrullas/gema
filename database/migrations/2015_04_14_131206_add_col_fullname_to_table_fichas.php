<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddColFullnameToTableFichas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::table('fichas', function(Blueprint $table){

            $table->string('full_name')->after('programa_id');


        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{ Schema::table('fichas', function(Blueprint $table){

        $table->dropColumn('full_name');


    });
	}

}
