<?php

use Illuminate\Database\Seeder;

class AmbitosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('ambitos')->insert(array(

            'nombre'=>'Ficha',
            'tabla'=>'fichas',
            'tabla_id'=>'id',
            'tabla_nombre'=>'codigo'

            //'empresa_id'=> 1,
        ));
        \DB::table('ambitos')->insert(array(

            'nombre'=>'IE',
            'tabla'=>'ies',
            'tabla_id'=>'id',
            'tabla_nombre'=>'nombre'

            //'empresa_id'=> 1,
        ));

        \DB::table('ambitos')->insert(array(

            'nombre'=>'AREAS-PROGRAMAS',
            'tabla'=>'areasprogramas',
            'tabla_id'=>'id',
            'tabla_nombre'=>'nombre'

            //'empresa_id'=> 1,
        ));

        \DB::table('ambitos')->insert(array(

            'nombre'=>'EMPRESA',
            'tabla'=>'empresas',
            'tabla_id'=>'id',
            'tabla_nombre'=>'nombre'

            //'empresa_id'=> 1,
        ));

    }
}
