<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class ListasTableSeeder extends Seeder{

    public function run()
    {

        $usuarios = \DB::table('users')->get();

        foreach($usuarios as $usuario) {
            \DB::table('listas')->insert(array(
                'nombre' => 'General',
                'descripcion' => 'No especifica',
                'user_id' => $usuario->id,
            ));
        }
        foreach($usuarios as $usuario) {
            \DB::table('listas')->insert(array(
                'nombre' => 'Personal',
                'descripcion' => 'No especifica',
                'user_id' => $usuario->id,
            ));
        }
        foreach($usuarios as $usuario) {
            \DB::table('listas')->insert(array(
                'nombre' => 'Estudio',
                'descripcion' => 'No especifica',
                'user_id' => $usuario->id,
            ));
        }


    }

}