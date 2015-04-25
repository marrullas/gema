<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class EventosTableSeeder extends Seeder{

    public function run()
    {
        $faker = Faker::create();

        for($i=0;$i<30;$i ++) {

            $_start = $faker->dateTimeThisMonth();
            //$_end => $_start

            \DB::table('eventos')->insert(array(
                'title'=> $faker->text(30),
                'all_day' => true,
                'start'=> $_start,
                'end'=>$_start,
                'user_id' => 1,
                'ficha_id' =>1,
                'descripcion' => $faker->text(200),
            ));

        }
    }

}