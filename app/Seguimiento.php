<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    //
    protected $table = 'seguimientos';
    protected $fillable = ['descripcion','detalles','estadoseguimientos','fecha_entrega',
    'user_id','user_id_seguimiento','visible', 'created_at'];

    public function setFechaEntregaAttribute($value)
    {
        if(!empty($value)) {
            $fecha = \Carbon\carbon::createFromFormat('d/m/Y H:i', $value);
            $this->attributes['fecha_entrega'] = $fecha;
        }
    }

    public function usuarioseguimiento(){

        return $this->belongsTo('\App\User','user_id_seguimiento','id');
/*        return $this->belongsTo('\App\User','user_id_seguimiento','id')
            ->where('users.full_name',"LIKE","%c%");*/
    }

    public function estadoseguimiento(){

        return $this->belongsTo('\App\Estadoseguimiento','estadoseguimientos','id');
    }

    public static function filtroPaginación($nombre,$estadoseg)
    {
         return Seguimiento::with(['usuarioseguimiento', 'estadoseguimiento'])
            ->nombre($nombre)
            ->estadoseguimiento($estadoseg)
            ->orderBy('seguimientos.id', 'DESC')
            ->paginate();
    }

    public function  scopeNombre($query, $name)
    {
        //esta condicion permite consultar los usuarios por nombre que tienen seguimiento
        if($name) {
            return $query->whereHas('usuarioseguimiento', function ($q) use ($name) {
                $q->where('users.full_name', "LIKE", "%$name%");
            });

        }
/*      se comenta este codido proque el join devolvia toda la informacion de la tabla usuario y generaba
        un problema al tratar de imprimir el campo de created_at de la tabla seguimiento
        if ($name) {
            return $query->join('users', function ($join) use ($name) {

             $join->on('user_id_seguimiento', '=' , 'users.id')
                ->where('users.full_name',"LIKE","%$name%");
            });
        }*/
    }
    public function  scopeEstadoseguimiento($query, $estado)
    {
        //esta condicion permite consultar los usuarios por nombre que tienen seguimiento
        if($estado) {
            return $query->where('estadoseguimientos', "=", "$estado");
        }


    }
}
