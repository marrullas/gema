<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class EstadosTableSeeder extends Seeder{

    public function run()
    {
        \DB::table('estados')->insert(array(

            'nombre'=>'Activo',
            'ambito'=>'ficha'
            ));
    }

}