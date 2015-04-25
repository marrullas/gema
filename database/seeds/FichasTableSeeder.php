<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class FichasTableSeeder extends Seeder{

    public function run()
    {
        \DB::table('fichas')->insert(array(
            'codigo'        => '731023',
            'fecha_ini'     => '01/01/2014',
            'fecha_fin'     => '12/31/2015',
            'user_id'     => 1,
            'ie_id'        => 1,
            'programa_id'   => 1,
        ));

    }

}