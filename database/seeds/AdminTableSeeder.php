<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 31/03/2015
 * Time: 3:40 PM
 */

class AdminTableSeeder extends Seeder{

    public function run()
    {
        \DB::table('users')->insert(array(
            'first_name'    => 'Mauricio',
            'last_name'     => 'Fernandez',
            'telefono1'     => '2238649',
            'telefono2'     => '3156436246',
            'email'         => 'marrullas@gmail.com',
            'type'          =>'admin',
            'password'      => \Hash::make('secret'),
            'full_name'     => 'Mauricio Fernandez'
            ));
    }

}