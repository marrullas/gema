<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoactividad extends Model {

	//
    protected $table = 'tipoactividad';

    protected $fillable = ['nombre','descripcion','color'];

    public function eventos()
    {
        return $this->hasMany('App\Evento');
    }

}
