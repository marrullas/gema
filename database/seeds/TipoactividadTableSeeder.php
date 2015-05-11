<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class TipoactividadTableSeeder extends Seeder{

    public function run()
    {
        \DB::table('tipoactividad')->insert(array(
            'nombre'        => '',
            'descripcion'     => 'No especifica',
        ));
        \DB::table('tipoactividad')->insert(array(
            'nombre'        => 'Formación',
            'descripcion'     => 'Actividad de formación de aprendices',
        ));
        \DB::table('tipoactividad')->insert(array(
            'nombre'        => 'Asesoria Pedagógica',
            'descripcion'     => 'Actividad de Asesoria Pedagógica',
        ));

        \DB::table('tipoactividad')->insert(array(
            'nombre'        => 'Desarrollo Curricular',
            'descripcion'     => 'Actividad de Reunión articulación',
        ));

        \DB::table('tipoactividad')->insert(array(
            'nombre'        => 'Reunión articulación',
            'descripcion'     => 'Actividad de Reunión articulación',
        ));


    }

}