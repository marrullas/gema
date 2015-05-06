<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class UserTableSeeder extends Seeder{

    public function run()
    {
/*        $faker = Faker::create();

        for($i=0;$i<100;$i ++) {

            $_firstname = $faker->firstName;
            $_lastname = $faker->lastName;

            \DB::table('users')->insert(array(
                'first_name'    => $_firstname,
                'last_name'     => $_lastname,
                'telefono1'     => $faker->phoneNumber,
                'telefono2'     => $faker->phoneNumber,
                'email'         => $faker->unique()->email,
                'type'          => $faker->randomElement(['user', 'user','user','user','user','user','instructor', 'ie', 'lider']),
                'password'      => \Hash::make('secret'),
                'full_name'     => "$_firstname $_lastname"
            ));

        }*/
        \DB::table('users')->insert(array(
            'first_name'    => 'Aldemar',
            'last_name'     => 'Vargas Medina',
            'documento'     => '94480514',
            'telefono1'     => '2238649',
            'telefono2'     => '3156436246',
            'email'         => 'aldevargas@sena.edu.co',
            'type'          =>'instructor',
            'password'      => \Hash::make('secret'),
            'full_name'     => 'Aldemar Vargas Medina'
        ));

        \DB::table('users')->insert(array(
            'first_name'    => 'Alvaro Hernan',
            'last_name'     => 'Vargas Medina',
            'documento'     => '94475502',
            'telefono1'     => '55555555',
            'telefono2'     => '55555555',
            'email'         => 'alibreros@sena.edu.co',
            'type'          =>'instructor',
            'password'      => \Hash::make('secret'),
            'full_name'     => 'Alvaro Hernan Libreros Zapata'
        ));

        \DB::table('users')->insert(array(
            'first_name'    => 'Andres Fernando',
            'last_name'     => 'Valencia Herrera',
            'documento'     => '6498966',
            'telefono1'     => '55555555',
            'telefono2'     => '55555555',
            'email'         => 'avalenciah@sena.edu.co',
            'type'          =>'instructor',
            'password'      => \Hash::make('secret'),
            'full_name'     => 'Andres Fernando Valencia Herrera'
        ));
    }

}