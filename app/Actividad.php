<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';
    protected $fillable = [
        'id','procedimiento_id','nombre','descripcion','responsable','obligatorio','orden',
        'condicional','aprobo','actividad_siguiente','entrega','numeroarchivos',
    ];

    public function procedimiento()
    {
        return $this->belongsTo('\App\Procedimiento');
    }
    public function files()
    {
        return $this->hasMany('\App\Files','codigo','id')->Filesactividad();
    }

    public static function filtroPaginación($nombre)
    {
        return Actividad::nombre($nombre)
            ->orderBy('id','ASC')
            ->paginate();
    }
    public function scopeNombre($query, $name)
    {
        if(!empty($name))
            return $query->where('nombre', "LIKE","%$name%");

    }
}
