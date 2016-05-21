<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    //
    protected $table = 'seguimientos';
    protected $fillable = ['descripcion','detalles','estadoseguimientos','fecha_entrega',
    'user_id','user_id_seguimiento','visible'];

    public function setFechaEntregaAttribute($value)
    {
        if(!empty($value)) {
            $fecha = \Carbon\carbon::createFromFormat('d/m/Y H:i', $value);
            $this->attributes['fecha_entrega'] = $fecha;
        }
    }

    public function usuarioseguimiento(){

        return $this->belongsTo('\App\User','user_id_seguimiento','id');
    }

    public function estadoseguimiento(){

        return $this->belongsTo('\App\Estadoseguimiento','estadoseguimientos','id');
    }

    public static function filtroPaginación($nombre)
    {
        return Seguimiento::with(['usuarioseguimiento', 'estadoseguimiento'])
            ->nombre($nombre)
            ->orderBy('seguimientos.id', 'ASC')
            ->paginate();
    }

    public function  scopeNombre($query, $name)
    {

        //return $query->where('usuarioseguimientos','full_name','LIKE',"%$name%");
        if ($name) {
            return $query->join('users', function ($join) use ($name) {

             $join->on('user_id_seguimiento', '=' , 'users.id')
                ->where('users.full_name',"LIKE","%$name%");
            });
        }
    }
}
