<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class IesTableSeeder extends Seeder{

    public function run()
    {
        \DB::table('ies')->insert(array(

            'nombre'    => 'JAA',
            'ciudad'    => 'San pedro',
            'dirección' => 'Crr 6 # 1-65',
            'telefono'  => '2268649',
            'mapa'      => null,
            'detalles'  => null,//nombre rector, coordinador, docente tecnico, telefons de C/U            ));
        ));
    }

}