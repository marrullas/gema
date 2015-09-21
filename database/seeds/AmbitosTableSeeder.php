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
            'nombre_tabla'=>'fichas',
            'campo_id'=>'fichas.id',
            'campo_user'=>'fichas.user_id',
            'campo_nombre'=>'fichas.full_name'

            //'empresa_id'=> 1,
        ));
        \DB::table('ambitos')->insert(array(

            'nombre'=>'IE',
            'nombre_tabla'=>'ies',
            'campo_id'=>'ies.id',
            'campo_user'=>'ies.user_id',
            'campo_nombre'=>'ies.nombre'

            //'empresa_id'=> 1,
        ));

        \DB::table('ambitos')->insert(array(

            'nombre'=>'AREAS-PROGRAMAS',
            'nombre_tabla'=>'areasprogramas',
            'campo_id'=>'areasprogramas.id',
            'campo_user'=>'areasprogramas.user_id',
            'campo_nombre'=>'areasprogramas.nombre'

            //'empresa_id'=> 1,
        ));

        \DB::table('ambitos')->insert(array(

            'nombre'=>'EMPRESA',
            'nombre_tabla'=>'empresas',
            'campo_id'=>'empresas.id',
            'campo_user'=>'empresas._user_id',
            'campo_nombre'=>'empresas.nombre'

            //'empresa_id'=> 1,
        ));

    }
}
