<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableComunSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
    {
                $faker = Faker::create();

                for($i=0;$i<20;$i ++) {

                    $_firstname = $faker->firstName;
                    $_lastname = $faker->lastName;

                    \DB::table('users')->insert(array(
                        'first_name'    => $_firstname,
                        'last_name'     => $_lastname,
                        'documento'     => $faker->randomNumber($nbDigits = NULL),
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
