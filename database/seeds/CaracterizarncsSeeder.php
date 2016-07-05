<?php

use Illuminate\Database\Seeder;

class CaracterizarncsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('caracterizarncs')->insert(array(

            'nombre'=>'Sin Evidencia',
            'descripcion'=>'No existe evidencia en la actividad',
            'orden'=>1
        ));
        \DB::table('caracterizarncs')->insert(array(
            'nombre'=>'Evidencia incompleta',
            'descripcion'=>'Existe evidencia pero esta incompleta',
            'orden'=>2
        ));
        \DB::table('caracterizarncs')->insert(array(

            'nombre'=>'Error de Contenido',
            'descripcion'=>'Existe el contenido pero no es pertinente',
            'orden'=>3
        ));
        \DB::table('caracterizarncs')->insert(array(

            'nombre'=>'Error de formato',
            'descripcion'=>'Se usa un formato erradoo o desactualizado',
            'orden'=>4
        ));
        \DB::table('caracterizarncs')->insert(array(

            'nombre'=>'Otro',
            'descripcion'=>'Error general',
            'orden'=>100
        ));
    }
}
