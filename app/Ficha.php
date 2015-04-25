<?php namespace App;


use Illuminate\Database\Eloquent\Model;

class Ficha extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fichas';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['codigo', 'fecha_ini', 'fecha_fin','user_id', 'estado', 'ie_id', 'programa_id'];


    public function eventos()
    {
        Return $this->hasMany('app\Evento');
    }



    public static function filtroPaginación($codigo, $type)
    {
        return User::codigo($codigo)
            ->type($type)
            ->orderBy('id','ASC')
            ->paginate();
    }


/*    public function scopeType($query, $type)
    {
        $types = config('options.types');

        if(!empty($type) && isset($types[$type]))
            $query->where('type','=',$type);


    }*/
}
