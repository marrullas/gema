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
            'first_name'    => 'ADMIN',
            'last_name'     => 'GEMA',
            'documento'     =>'6445797',
            'telefono1'     => '2238649',
            'telefono2'     => '3156436246',
            'email'         => 'marrullas@gmail.com',
            'type'          =>'admin',
            'password'      => \Hash::make('secret'),
            'full_name'     => 'Mauricio Fernandez'
            ));
        \DB::table('users')->insert(array(
            'first_name'    => 'Andres',
            'last_name'     => 'Prieto',
            'documento'     => '11111111',
            'telefono1'     => '2238649',
            'telefono2'     => '3156436246',
            'email'         => 'aprieto@misena.edu.co',
            'type'          =>'lider',
            'password'      => \Hash::make('secret'),
            'full_name'     => 'Andres Prieto'
        ));
    }

}
