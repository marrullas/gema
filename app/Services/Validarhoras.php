<?php namespace App\Services;

use App\Evento;
use App\Ficha;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class ValidarHoras extends Validator{
    //added only for test
    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateSolapada($attribute, $value, $parameters)
    {

        //dd($parameters);

        $all_day = $parameters[3];

        if($all_day == 'on')
            $all_day = 1;

        if(empty($parameters[0]))
            $ficha_id = 0;
        else
            $ficha_id = $parameters[0];

        $fecha_ini = new Carbon($parameters[1]);
        $fecha_fin = new Carbon($parameters[2]);

        //dd($fecha_ini);

        $mes = Carbon::now()->startOfMonth();
        //dd($parameters);
        if(count($parameters)>4) { //edicion de evento
            $id_evento = $parameters[4];

            $fichasxuser = Evento::select('eventos.ficha_id')
                ->where('id','!=',$id_evento)
                ->where('start', '>=', $mes)
                ->where('user_id', '=', Auth::user()->id)
                ->groupby('ficha_id')
                ->get()->lists('ficha_id');
            //dd($fichasxuser);

            //valida si hay un evento marcado para todo el dia en la misma fecha
            $ficha = Evento::where('all_day', '=', true)
                ->where('id','!=',$id_evento)
                ->where('user_id', '=', Auth::user()->id)
                ->whereIn('ficha_id', $fichasxuser)
                ->whereRaw('date(start) = ?', [$fecha_ini->format('Y-m-d')])
                ->get();
            //dd($ficha);
            if ($ficha->count() > 0)
                return false;


            //valida que exista un evento para esa fecha
            $ficha = Evento::where('all_day', '=', false)
                ->where('id','!=',$id_evento)
                ->where('user_id', '=', Auth::user()->id)
                ->whereRaw('date(start) = ?', [$fecha_ini->format('Y-m-d')])
                //->whereRaw('date(start) = ?', [$fecha_ini->format('Y-m-d')])
                ->get();
            //dd($ficha->count());
            //si encontro un evento y quiere crear un evento de todo el día no lo deja
            if ($ficha->count() > 0 && $all_day == 1)
                return false;

            //busca si existen eventos las mismas horas que esta tratanto de crear
            $ficha = Evento::where('id','!=',$id_evento)
                ->where('user_id', '=', Auth::user()->id)
                ->where(function($query) use ($fecha_ini,$fecha_fin){
                    $query->WhereBetween('start', [$fecha_ini, $fecha_fin]);
                    $query->OrWhereBetween('end', [$fecha_ini, $fecha_fin]);
                    $query->OrWhereRaw("? between start and end",[$fecha_ini]);
                  })

                //->whereRaw('date(start) = ?', [$fecha_ini->format('Y-m-d')])
                ->get();
            //dd($ficha);
            if ($ficha->count() > 0)
                return false;
        }
        else {///creacion de evento


            $fichasxuser = Evento::select('eventos.ficha_id')
                ->where('start', '>=', $mes)
                ->where('user_id', '=', Auth::user()->id)
                ->groupby('ficha_id')
                ->get()->lists('ficha_id');
            //dd($fichasxuser);

            //valida si hay un evento marcado para todo el dia en la misma fecha
            $ficha = Evento::where('all_day', '=', true)
                ->where('user_id', '=', Auth::user()->id)
                ->where(function($query) use ($fecha_ini,$fichasxuser) {
                    $query->whereIn('ficha_id', $fichasxuser);
                    $query->whereRaw('date(start) = ?', [$fecha_ini->format('Y-m-d')]);
                })
                ->get();
            //dd($ficha);
            if ($ficha->count() > 0)
                return false;


            //valida que exista un evento para esa fecha y venga marcado para todo el dia
            $ficha = Evento::where('all_day', '=', false)
                ->where('user_id', '=', Auth::user()->id)
                ->where(function($query) use ($fecha_ini) {
                    $query->whereRaw('date(start) = ?', [$fecha_ini->format('Y-m-d')]);
                })
                //->whereRaw('date(start) = ?', [$fecha_ini->format('Y-m-d')])
                ->get();
            //dd($ficha->count());
            //si encontro un evento y quiere crear un evento de todo el día no lo deja
            if ($ficha->count() > 0 && $all_day == 1)
                return false;

            //busca si existen eventos las mismas horas que esta tratanto de crear
            $ficha = Evento::WhereBetween('start', [$fecha_ini, $fecha_fin])
                ->where('user_id', '=', Auth::user()->id)
                ->OrWhere(function($query) use ($fecha_ini,$fecha_fin) {
                    $query->OrWhereBetween('end', [$fecha_ini, $fecha_fin]);
                    $query->OrWhereRaw("? between start and end", [$fecha_ini]);
                })
                //->whereRaw('date(start) = ?', [$fecha_ini->format('Y-m-d')])
                ->get();

            //dd($ficha);

            if ($ficha->count() > 0)
                return false;

            //dd('paso');
        }
        return true;
    }

    public function Validateisweekend($attribute, $value, $parameters)
    {
        $start = new Carbon($value);
        if($start->isWeekend())
            return false;

        return true;

    }
}