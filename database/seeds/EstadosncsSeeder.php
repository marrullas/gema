<?php

use Illuminate\Database\Seeder;

class EstadosncsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('estadoncs')->insert(array(

            'nombre'=>'Abierta',
            'descripcion'=>'proceso de revisión'
        ));
        \DB::table('estadoncs')->insert(array(

            'nombre'=>'Devuelta',
            'descripcion'=>'Cuando un usuario a realizado acción correctiva se devuelve para ser certificado'
        ));
        \DB::table('estadoncs')->insert(array(

            'nombre'=>'Cerrada',
            'descripcion'=>'NC cerrada por un auditor'
        ));
    }
}
