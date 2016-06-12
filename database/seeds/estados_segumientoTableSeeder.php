<?php

use Illuminate\Database\Seeder;

class estados_segumientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('estadoseguimientos')->insert(array(

            'nombre'=>'Positivo',
            'descripcion'=>'Seguimiento Positivo',
            'positivo'=>true,
            'icono'=>'fa-thumbs-o-up',
            'color' => '#5cb85c'
        ));
        \DB::table('estadoseguimientos')->insert(array(

            'nombre'=>'Negativo',
            'descripcion'=>'Seguimiento Negativo',
            'positivo' => false,
            'icono'=>'fa-thumbs-o-down',
            'color' => '#d9534f'
        ));

        \DB::table('estadoseguimientos')->insert(array(

            'nombre'=>'Pendiente',
            'descripcion'=>'Seguimiento pendiente',
            'icono'=>'fa-clock-o',
            'color' => '#f0ad4e'


        ));
        \DB::table('estadoseguimientos')->insert(array(

            'nombre'=>'Terminado',
            'descripcion'=>'Seguimiento Positivo',
            'positivo'=>true,
            'icono'=>'fa-thumbs-o-up',
            'color' => '#5cb85c'


        ));

    }
}
