<?php

use App\Entrega;
use Illuminate\Database\Seeder;

class EntregasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ciclos = \App\Ciclo::all();
        foreach($ciclos as $ciclo) {
            $actividades = $ciclo->actividades()->get();
            foreach ($actividades as $actividad) {
                $entrega = new Entrega();
                $entrega->actividad_id = $actividad->id;
                $entrega->ciclo_id = $ciclo->id;
                $entrega->save();
            }
        }
    }
}
