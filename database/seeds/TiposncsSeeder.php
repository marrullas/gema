<?php

use Illuminate\Database\Seeder;

class TiposncsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('tiposnc')->insert(array(

            'hallazgo'=>'Observación',
            'accion'=>'Acción de mejora',
            'prioridad'=>'Baja'
        ));
        \DB::table('tiposnc')->insert(array(

            'hallazgo'=>'NC menor potencial',
            'accion'=>'Acción preventiva',
            'prioridad'=>'Media'
        ));
        \DB::table('tiposnc')->insert(array(

            'hallazgo'=>'NC menor real',
            'accion'=>'Corrección o acción correctiva',
            'prioridad'=>'Media'
        ));
        \DB::table('tiposnc')->insert(array(

            'hallazgo'=>'NC mayor',
            'accion'=>'Correción y acción correción inmediata',
            'prioridad'=>'Alta'
        ));

    }
}
