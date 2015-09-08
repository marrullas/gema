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

            'nombre'=>'Formación titulada',
            'descripcion'=>'Formación en centros SENA',
            //'empresa_id'=> 1,
        ));
        \DB::table('areasprogramas')->insert(array(

            'nombre'=>'Integración con la media técnica',
            'descripcion'=>'Formación técnica en las I.E publicas y privadas articualadas con el SENA',
            //'empresa_id'=> 1,
        ));
        \DB::table('areasprogramas')->insert(array(

            'nombre'=>'Jovenes rurales',
            'descripcion'=>'Formación formación para el trabajo con el SENA',
            //'empresa_id'=> 1,
        ));
    }
}
