<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name');
            $table->string('last_name');
            $table->string('telefono1',20);
            $table->string('telefono2',20)->nullable();
			$table->string('email')->unique();
			$table->string('password', 60);
            $table->enum('type',['admin','user','instructor','ie','lider']);
            $table->string('full_name');
            //$table->timestamp('last_login')->nullable();
			$table->rememberToken();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('users');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
