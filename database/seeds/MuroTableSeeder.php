<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class MuroTableSeeder extends Seeder{

    public function run()
    {
        $faker = Faker::create();

        for($i=0;$i<30;$i ++) {

            $user_id = DB::table('users')
                ->select('id')
                ->orderBy(DB::raw('RAND()'))
                ->first()
                ->id;



            $_start = $faker->dateTimeThisMonth();
            //$_end => $_start

            \DB::table('muro')->insert(array(
                'user_id'=> $user_id,
                'mensaje'=>  $faker->text(200)
                //'caducidad' => $faker->dateTimeBetween($starDate = 'now', $endDate = '30 years'),
            ));

        }
    }

}