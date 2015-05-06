<?php namespace App;

use Illuminate\Database\Eloquent\Model;



class Programa extends Model {

	protected $fillable = ['nombre','codigo','version','linea','red'];
    protected $table = 'programas';


    public function fichas()
    {
        return $this->hasMany('app\Ficha');
    }
    public static function filtroPaginación($nombre)
    {
        return Programa::nombre($nombre)
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
