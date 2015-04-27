<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('AdminTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('EstadosTableSeeder');
        $this->call('IesTableSeeder');
        $this->call('ProgramasTableSeeder');
        $this->call('FichasTableSeeder');
        $this->call('EventosTableSeeder');
	}

}