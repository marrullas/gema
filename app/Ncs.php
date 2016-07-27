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

    public static function ncsxuaditor($auditor = null)
    {
        $ncs = null;
        if (empty($auditor))
        {
            $ncs = Ncs::select(DB::raw('count(*) as numeroncs, auditor, users.full_name'))
                ->join('users','users.id','=','ncs.auditor')
                ->groupBy('ncs.auditor')
                ->get();

        }else{
            $ncs = Ncs::select(DB::raw('count(*) as numeroncs, auditor, users.full_name'))
                ->join('users','users.id','=','ncs.auditor')
                ->where('ncs.auditor',$auditor)
                ->groupBy('ncs.auditor')
                ->get();

        }

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

    public function scopeUsuario($query, $user)
    {
        if(!empty($user))
        {
            $query->where('user_id', "=", $user);
        }
    }
    public function scopeAuditor($query, $auditor)
    {
        if(!empty($auditor))
        {
            $query->where('auditor', "=", $auditor);
        }
    }


}
