<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class ProgramasTableSeeder extends Seeder{

    public function run()
    {
/*        \DB::table('programas')->insert(array(
            'nombre'    => 'Tecnico en sistemas',
            'codigo'    => '229185',
            'version'   => 'v.1',
            'linea'     => null,
            'red'       => null,
        ));*/

        \DB::table('programas')->insert(array(
            'nombre'    => 'Tecnico en programación de software',
            'codigo'    => '229185',
            'version'   => 'v.1',
            'linea'     => null,
            'red'       => null,
        ));
    }

}