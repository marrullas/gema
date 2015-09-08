<?php

use Illuminate\Database\Seeder;

class AreasprogramasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('areasprogramas')->insert(array(

            'nombre'=>'Formaci�n titulada',
            'descripcion'=>'Formaci�n en centros SENA',
            //'empresa_id'=> 1,
        ));
        \DB::table('areasprogramas')->insert(array(

            'nombre'=>'Integraci�n con la media t�cnica',
            'descripcion'=>'Formaci�n t�cnica en las I.E publicas y privadas articualadas con el SENA',
            //'empresa_id'=> 1,
        ));
        \DB::table('areasprogramas')->insert(array(

            'nombre'=>'Jovenes rurales',
            'descripcion'=>'Formaci�n formaci�n para el trabajo con el SENA',
            //'empresa_id'=> 1,
        ));
    }
}
