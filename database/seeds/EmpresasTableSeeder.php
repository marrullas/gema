<?php

use Illuminate\Database\Seeder;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('empresas')->insert(array(

            'nombre'=>'CAB',
            'descripcion'=>'Centro Agropecuario de Buga',
            'fechacorte'=> '31/12/2016'
        ));
    }
}
