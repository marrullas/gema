<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    //
    protected $fillable = ['id','actividad_id','ciclo_id','fecha','numeroarchivos','descripcion','documento_id'];


    public function ciclo()
    {
        return $this->belongsTo('\App\Ciclo');
    }
    public function actividad()
    {
        return $this->belongsTo('\App\Actividad');
    }
    public function documento()
    {
        return $this->belongsTo('\App\Documento');
    }
    public function files()
    {
        return $this->hasMany('\App\Files','codigo','id')->where('prefijo','=','EN');
    }
    public function filesCount()
    {
        return $this->files()->selectRaw('files.codigo, count(*) as count')->groupBy('files.codigo');
    }
    public static function filtroPaginacion($id)
    {
        return Entrega::Id($id)->with('actividad','ciclo','documento')
            ->orderBy('id','ASC')
            ->paginate();
    }
    public function scopeId($query, $id)
    {
        if(!empty($id))
            return $query->where('id', "=","%$id%");

    }
    public static function filtroPaginacionCiclo($id)
    {
        return Entrega::CicloId($id)
            ->orderBy('actividad_id','ASC')
            ->orderBy('id','ASC')
            ->paginate();
    }
    public function scopeActividadId($query, $id)
    {
        if(!empty($id))
            return $query->where('actividad_id', "=",$id);

    }
    public function scopeCicloId($query, $id)
    {
        if(!empty($id))
            return $query->where('ciclo_id', "=",$id);

    }
    public function setFechaAttribute($value)
    {
        if(!empty($value)) {
            $fecha = \Carbon\carbon::createFromFormat('d/m/Y', $value);
            $this->attributes['fecha'] = $fecha;
        }
    }

}
