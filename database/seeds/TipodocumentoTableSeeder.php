<?php

use Illuminate\Database\Seeder;

class TipodocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('tipodocumento')->insert(array(

            'nombre'=>'Formato',
            'descripcion'=>'Plantilla para registrar información',
            //'empresa_id'=> 1,
        ));
        \DB::table('tipodocumento')->insert(array(

            'nombre'=>'Registro',
            'descripcion'=>'Documento registrar informacion',
            //'empresa_id'=> 1,
        ));
        \DB::table('tipodocumento')->insert(array(

            'nombre'=>'Evidencia',
            'descripcion'=>'Evidencia de alguna actividad desarrollada',
            //'empresa_id'=> 1,
        ));
        \DB::table('tipodocumento')->insert(array(

            'nombre'=>'Apoyo',
            'descripcion'=>'Documento de ayuda o didáctica',
            //'empresa_id'=> 1,
        ));
    }
}
