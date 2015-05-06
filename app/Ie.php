<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ie extends Model {

	//
    protected $table = 'ies';

    protected $fillable = ['nombre','nit','tipo','modalidad','email','ciudad','direccion','telefono','nombre_rector',
                            'email_rector','tel_rector','detalles'];

    public function fichas()
    {
        return $this->hasMany('app\Ficha');
    }
    public static function filtroPaginación($nombre)
    {
        return Ie::nombre($nombre)
            ->orderBy('id','ASC')
            ->paginate();
        //return Programa::paginate();
    }

    public function scopeNombre($query, $name)
    {
        if(!empty($name))
            return $query->where('nombre', "LIKE","%$name%");

    }


}
