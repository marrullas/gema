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
            $table->string('documento',20)->unique();
            $table->string('telefono1',20);
            $table->string('telefono2',20)->nullable();
			$table->string('email')->unique();
            $table->string('email2')->unique()->nullable();
            $table->string('titulo')->nullable();
            $table->string('profesion')->nullable();
            $table->date('fecha_nac')->nullable();
            $table->integer('ciudad')->default(1);
			$table->string('password', 60);
            $table->enum('type',['admin','user','instructor','ie','lider'])->default('user');
            $table->string('full_name');
            $table->timestamp('last_login')->nullable();
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
