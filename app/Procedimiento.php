<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    //
    protected $table = 'procedimientos';
    protected $fillable = ['id','nombre','objetivo','responsable','alcance','generalidades','user_id','version','codigo'
    ,'vigencia','proceso'];

    public static function filtroPaginación($nombre)
    {
        return Procedimiento::nombre($nombre)
            ->orderBy('id','ASC')
            ->paginate();
    }
    public function scopeNombre($query, $name)
    {
        if(!empty($name))
            return $query->where('nombre', "LIKE","%$name%");

    }

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function setVigenciaAttribute($value)
    {

        $fecha =  \Carbon\carbon::createFromFormat('d/m/Y',$value);
        $this->attributes['vigencia'] = $fecha;
    }
}
