<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ncs extends Model
{
    //
    protected $table = 'ncs';
    protected $fillable = ['auditoria_id','user_id','auditor','certificador',
                            'estadoncs_id','descripcion','tiposnc_id','medida','plazo','caracterizarncs_id'];


    public function setPlazoAttribute($value)
    {
        $fecha =  \Carbon\carbon::createFromFormat('d/m/Y',$value);
        $this->attributes['plazo'] = $fecha;
    }
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function revisor()
    {
        return $this->belongsTo('\App\User','auditor','id');
    }
    public function certificador()
    {
        return $this->belongsTo('\App\User');
    }
    public function auditoria()
    {
        return $this->belongsTo('\App\Auditoria');
    }
    public function estadoncs()
    {
        return $this->belongsTo('\App\Estadosncs','estadoncs_id','id');
    }
    public function tiponc()
    {
        return $this->belongsTo('\App\Tiposnc','tiposnc_id','id');
    }
    public function seguimientos()
    {
        return $this->hasMany('\App\Seguimientoncs');
    }
    public function caracterizacion()
    {
        return $this->belongsTo('\App\Caracterizarncs','caracterizarncs_id','id');
    }

    public function scopeNcsresueltas($query)
    {
        return $query->estadoncs()->where('nombre','=','Cerrada');
    }
    public function scopeNcspendientes($query)
    {
        return $query->estadoncs()->where('nombre','=','Abierta');
    }

    public static function ncsxuaditor($ciclo = null, $auditor = null, $usuario =  null)
    {
        $ncs = null;
          $ncs = Ncs::select(DB::raw('count(*) as numeroncs, auditor, users.full_name'))
                ->join('users','users.id','=','ncs.auditor')
                ->ciclo($ciclo)
                ->auditor($auditor)
                ->usuario($usuario)
                ->groupBy('ncs.auditor')
                ->get();

        return $ncs;
    }

/*    public function scopeAuditor($query,$auditor)
    {
        if (!empty($auditor))
            return $query->where('ncs.auditor',$auditor)
    }*/


    public static function ncsxuaditorxciclo($ciclo = null)
    {
        $ncs = null;

        $ncs = DB::select(DB::raw("select count(*) as numeroncs, auditor, users.full_name from ncs 
          join users on users.id = ncs.auditor
          join auditoria on ncs.auditoria_id = auditoria.id
          join usuariosxciclo on auditoria.usuariosxciclo_id = usuariosxciclo.id
          join ciclos on usuariosxciclo.ciclo_id = ciclos.id and ciclos.activo = 1 and ciclos.id = ".$ciclo."
           group by(users.full_name)
           "));
        return $ncs;
    }
    /*
     * Funcion retorna el numero de ncs x activdad para un ciclo
     */
    public static function ncsxactividadxciclo($ciclo = null, $auditor = null, $usuario = null)
    {
        $ncs = [];
        if(!empty($ciclo)) {

            $query = "select count(*) as numeroncs, actividad_id, actividades.nombre from ncs          
          join auditoria on ncs.auditoria_id = auditoria.id
          join actividades on actividades.id = auditoria.actividad_id
          join usuariosxciclo on auditoria.usuariosxciclo_id = usuariosxciclo.id
          join ciclos on usuariosxciclo.ciclo_id = ciclos.id and ciclos.activo = 1 and ciclos.id = '$ciclo' ";

            if(!empty($auditor))
                $query .= " where auditor = '$auditor'";

            if(!empty($usuario) && !empty($auditor))
                $query .= " and ncs.user_id = '$usuario'";
            elseif (!empty($usuario))
                $query .= " where ncs.user_id = '$usuario'";
/*            $ncs = DB::select(DB::raw("select count(*) as numeroncs, actividad_id, actividades.nombre from ncs
          join auditoria on ncs.auditoria_id = auditoria.id
          join actividades on actividades.id = auditoria.actividad_id
          join usuariosxciclo on auditoria.usuariosxciclo_id = usuariosxciclo.id
          join ciclos on usuariosxciclo.ciclo_id = ciclos.id and ciclos.id = " . $ciclo . "
           group by(actividad_id)
           "));*/

            $query .= " group by(actividad_id)";
            $ncs = DB::select(DB::raw($query));
        }
        //dd($ncs);
        return $ncs;
    }
    /*
 * Esta funcion devuelve el listado de usuarios que tienen nc creado por un auditor
 */
    public static function usuariosncdeauditor($auditor = null,$usuario= null)
    {
        return User::whereIn('id',function($queyry) use ($auditor,$usuario)
            {
                if(!empty($auditor) && !empty($usuario)) {
                    $queyry->select(DB::raw('user_id'))
                        ->from('ncs')
                        ->whereRaw('auditor = ' . $auditor)
                        ->whereRaw('user_id = ' . $usuario);;
                }elseif (!empty($auditor))
                {
                    $queyry->select(DB::raw('user_id'))
                        ->from('ncs')
                        ->whereRaw('auditor = ' . $auditor);
                }
                else{
                    if(!empty($usuario)) {
                        $queyry->select(DB::raw('user_id'))
                            ->from('ncs')
                            ->whereRaw('user_id = ' . $usuario);
                    }
                    else
                    {
                        $queyry->select(DB::raw('user_id'))
                            ->from('ncs');
                    }
                }
            })
            ->lists('full_name','id')->all();
            //->get();

    }

    public static function ncsxusuarioxauditor($auditor,$user, $page)
    {
        return Ncs::usuario($user)
            ->auditor($auditor)
            ->paginate();
    }
    public function scopeCiclo($query, $ciclo)
    {
        if(!empty($ciclo))
        {
            $query->join('auditoria','ncs.auditoria_id','=','auditoria.id')
                ->join('usuariosxciclo','auditoria.usuariosxciclo_id','=','usuariosxciclo.id')
                ->join('ciclos', function($join) use ($ciclo) {
                $join->on('ciclos.id','=','usuariosxciclo.ciclo_id')
                    ->where('ciclos.id','=',$ciclo);
            });

        }
    }
    public function scopeUsuario($query, $user)
    {
        if(!empty($user))
        {
            $query->where('ncs.user_id', "=", $user);
        }
    }
    public function scopeAuditor($query, $auditor)
    {
        if(!empty($auditor))
        {
            $query->where('ncs.auditor', "=", $auditor);
        }
    }


}
