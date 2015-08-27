<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    //
    protected $table = 'actas';
    protected $fillable = ['id',
        'prefijo',
        'evento_id',
        'user_id',
        'archivo',
        'archivo_nombre',
        'archivo_ext',
        'fecha_archivo',
        'justificacion'
    ];

    public function user()
    {
        return $this->belongsTo('\App\User','user_id','id');
    }
    public function evento()
    {
        return $this->belongsTo('\App\Evento','evento_id','id');
    }
    public static function filtroPaginación($user_id)
    {
        return Acta::with('user','evento')
            ->where('user_id','=',$user_id)
            ->orderBy('id','ASC')
            ->paginate();
        //return Programa::paginate();
    }
    public static function filtroPaginaciónTodas($nombre)
    {
        return Acta::with('user','evento')
            ->select('actas.*')
            ->name($nombre)
            //->where('user_id','=',$user_id)
            ->orderBy('actas.id','ASC')
            ->paginate();
        //return Programa::paginate();
    }

    public function scopeName($query,$nombre)
    {
        if(!empty($nombre)) {
            return $query
                ->join('users','actas.user_id','=','users.id')
                ->where('users.full_name','like',"%$nombre%");


        }
    }
}
