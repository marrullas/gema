<?php namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{

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
    protected $fillable = ['codigo', 'fecha_ini', 'fecha_fin', 'grado', 'user_id', 'estado', 'ie_id', 'programa_id', 'full_name','horasacumuladas'];

    protected $appends = ['horas_acumuladas'];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function eventos()
    {
        Return $this->hasMany('\App\Evento');
    }

    public function ie()
    {
        return $this->belongsTo('\App\Ie');
    }

    public function programa()
    {
        return $this->belongsTo('\App\Programa');
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getHorasAcumuladasAttribute()
    {
         $horas = $this->hasMany('\App\Evento')
            ->selectRaw('sum(horas) as horas')
             ->where('start', '>=', Carbon::now()->startOfMonth())//acumla solamente lo de este mes
            ->groupBy('ficha_id')
            ->get();
        //dd($horas->all()->horas);
        return $horas;
    }


    public static function filtroPaginación($codigo)
    {
        return Ficha::with(['user','ie','programa'])->codigo($codigo)
            //->type($type)
            ->orderBy('id','ASC')
            ->paginate();
    }

/*    public function getUserName()
    {
        return
    }*/




    public function scopeCodigo($query, $codigo)    {


        if(!empty($codigo))
            $query->where('codigo','=',$codigo);


    }


}
