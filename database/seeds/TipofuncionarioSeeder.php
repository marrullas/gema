<?php

use Illuminate\Database\Seeder;

class TipofuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipofuncionario')->insert(array(

            'nombre'=>'Rector',
            'descripcion'=>'rector IE'
        ));
        \DB::table('tipofuncionario')->insert(array(

            'nombre'=>'Coordinador',
            'descripcion'=>'Coordinador IE'
        ));
        \DB::table('tipofuncionario')->insert(array(

            'nombre'=>'Docente',
            'descripcion'=>'Docente tecnico IE'
        ));
        \DB::table('tipofuncionario')->insert(array(

            'nombre'=>'Otro',
            'descripcion'=>'funcionario IE'
        ));
    }
}
