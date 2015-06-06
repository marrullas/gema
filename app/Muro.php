<?php namespace App;


use Carbon;
use Illuminate\Database\Eloquent\Model;

class Muro extends Model  {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'muro';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'mensaje', 'caducidad','tipo', 'estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('app\User');
    }

    /**
     * @return retorna todas las entradas del muro
     */
    public static function getEntradas()
    {
        return Muro::where('tipo','!=','anuncio')
            ->orderBy('created_at','desc')
            ->limit(20)
            ->get();

    }

    public static function getAnuncios()
    {
        return Muro::where('tipo','anuncio')
                    ->orderBy('created_at','desc')
                    ->limit(20)
                    ->get();
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }


}
