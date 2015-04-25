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
        $faker = Faker::create();

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

        }
    }

}