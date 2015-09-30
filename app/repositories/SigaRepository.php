<?php
/**
 * Created by PhpStorm.
 * User: ticbox
 * Date: 22/06/2015
 * Time: 11:05 PM
 */
namespace  App\Repositories;


use App\Evento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class EventoRepository {

    /**
     * Devuelve los eventos del mes aagrupados por ficha
     * @param $user
     * @return mixed
     */
    public function fichasasignadas($user)
    {
        return Evento::with('ficha','ficha.ie','ficha.ie.ciudad','ficha.programa')
            ->select(DB::raw('*,sum(eventos.horas) as horas'))
            ->where('eventos.user_id',$user->id)
            ->where('eventos.start', '>=', Carbon::now()->startOfMonth())
            ->groupBy('ficha_id')
            ->orderBy('eventos.start','')
            ->get();
    }

    /**
     * devuelve los eventos del mes para un usuario
     * @param $user
     * @return mixed
     */
    public function  vereventos($user)
    {
        return Evento::with('ficha','ficha.ie','ficha.ie.ciudad','ficha.programa')
            //->join('fichas','fichas.id','=','eventos.ficha_id')
            ->where('eventos.user_id',$user->id)
            ->where('eventos.start', '>=', Carbon::now()->startOfMonth())
            //->groupBy('ficha_id')
            ->orderBy('eventos.start','')
            ->get();
    }

    public function acumuladoxficha($user = null, $fechas = null)
    {
        $rango = $this->getRango($fechas);
        //dd($rango);
        return Evento::with('ficha','ficha.ie','ficha.ie.ciudad','ficha.programa')
            ->select(DB::raw('*,sum(eventos.horas) as horas'))
            //->join('fichas','fichas.id','=','eventos.ficha_id')
            ->where('eventos.user_id',$user->id)
            //->where('eventos.start', '>=', Carbon::now()->startOfMonth())
            ->WhereBetween('eventos.start', [$rango['fecha_ini'],$rango['fecha_fin']])
            ->groupBy('ficha_id')
            ->orderBy('eventos.start','')
            ->get();
    }
    public function HorasAcumuladas($user, $fechas=null)
    {
        //dd($user);

        $rango = $this->getRango($fechas);
        //dd($rango);
        $horas = Evento::selectRaw('sum(horas) as horas')
            //->where('start', '>=', Carbon::now()->startOfMonth())//acumla solamente lo de este mes
            ->where('user_id','=',$user->id)
            ->WhereBetween('start',[$rango['fecha_ini'],$rango['fecha_fin']])
            ->groupBy('user_id')
            ->get();
        return $horas;
    }
    /**
     * Retorna fechas en formato correcto para hacer consultas sobre la base de datos
     * @param null $fechas
     * fechas recibidas desde el formulario
     * @return array
     */
    private function getRango($fechas)
    {
        $timezone = Config::get('app.timezone', 'UTC');
        if(empty($fechas))
        {
            //$mes = Carbon::now();
            $rango["fecha_ini"] = Carbon::now()->startOfMonth();
            $rango["fecha_fin"]=Carbon::now()->endOfMonth();
        }
        else
        {


            $rango["fecha_ini"] = Carbon::createFromFormat('d/m/Y', $fechas[0],$timezone)->format('Y-m-d 00:00:00');
            $rango["fecha_fin"]= Carbon::createFromFormat('d/m/Y', $fechas[1],$timezone)->format('Y-m-d 23:59:59');

            //$rango = array('fecha_ini'=>$fecha_ini,'fecha_fin'=>Carbon::createFromFormat('d/m/Y', $fechas[1])->format('Y-m-d 23:59:59.000000'));
        }


        return $rango;
    }

}