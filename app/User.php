<?php namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'full_name','documento', 'telefono1', 'telefono2', 'email', 'email2', 'titulo', 'profesion','fecha_nac','ciudad','password', 'type', 'last_login'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function bio()
    {
        return $this->hasOne('\App\Bio');
    }

    public function eventos()
    {
        return $this->hasMany('\App\Evento');
    }

    public function muros()
    {
        return $this->hasMany('\App\Muro');
    }
    public function fichas()
    {
        return $this->hasMany('\App\Ficha');
    }
// inhabilitado interfiere cuando se intenta mostar el nombre en formulario ficha
/*    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }*/

    /**
     * encripta la contraseña del usuario
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        /** @var TYPE_NAME $value */
        if(!empty($value)) {
            if (Hash::needsRehash($value)) {//valida aun no este encriptada
                $this->attributes['password'] = bcrypt($value);
            }

        }
    }


    public static function filtroPaginación($name, $type)
    {

        return User::name($name)
            ->type($type)
            ->orderBy('full_name','ASC')
            ->paginate();
    }
    public static function filtroResumen($name, $type, $periodo,$programacion)
    {

        if(empty($programacion)) {
            $result = User::name($name)->with('eventos')
                ->type($type)
                ->periodo($periodo)
                ->orderBy('users.id', 'ASC')
                ->groupBy('users.id')
                ->select(DB::raw('SUM(horas) as horas, count(eventos.user_id) as nueventos,count(DISTINCT date(start)) as dias'), 'users.full_name', 'users.id')
                ->paginate();
        }else{
            $result = User::name($name)->with('eventos')
                ->type($type)
                ->sinprogramacion($periodo)
                ->orderBy('users.id', 'ASC')
                ->groupBy('users.id')
                ->select(DB::raw('0 as horas, 0 as nueventos,0 as dias'), 'users.full_name', 'users.id')
                ->paginate();
        }

        //dd($result);
        return $result;
    }
    public function scopeName($query, $name)
    {
        if(!empty($name))
            return $query->where('full_name', "LIKE","%$name%");

    }

    public function scopeType($query, $type)
    {
        $types = config('options.types');

        if(!empty($type) && isset($types[$type]))
            $query->where('type','=',$type);


    }

    public  function scopePeriodo($query, $periodo)
    {

            switch($periodo){

                case ('mes'):
                    $rango1 = Carbon::now()->startOfMonth();
                    $rango2 = Carbon::now()->endOfMonth();
                break;
                case ('semana'):
                    $rango1 = Carbon::now()->startOfWeek();
                    $rango2 = Carbon::now()->endOfWeek();
                break;
                case ('anterior'):
                    $rango1 = Carbon::now()->startOfMonth()->subMonth();
                    $rango2 = Carbon::now()->endOfMonth()->subMonth();
                    break;

                default:
                    $rango1 = Carbon::now()->startOfMonth();
                    $rango2 = Carbon::now()->endOfMonth();
                break;

            }

            $query->join('eventos','eventos.user_id','=','users.id')
                ->whereBetween('start',[$rango1, $rango2]);


    }

    public  function scopeSinprogramacion($query, $periodo)
    {

        switch($periodo){

            case ('mes'):
                $rango1 = Carbon::now()->startOfMonth();
                $rango2 = Carbon::now()->endOfMonth();
                break;
            case ('semana'):
                $rango1 = Carbon::now()->startOfWeek();
                $rango2 = Carbon::now()->endOfWeek();
                break;
            case ('anterior'):
                $rango1 = Carbon::now()->startOfMonth()->subMonth();
                $rango2 = Carbon::now()->endOfMonth()->subMonth();
                break;

            default:
                $rango1 = Carbon::now()->startOfMonth();
                $rango2 = Carbon::now()->endOfMonth();
                break;

        }

        $query->whereNotIn('users.id',function($q) use ($rango1,$rango2){
                $q->select('users.id')
                    ->from('users')
                    ->join('eventos','eventos.user_id','=','users.id')
                    ->whereBetween('start',[$rango1, $rango2]);
            });



    }

    public function isAdmin()
    {
        return $this->type === 'admin';
    }

    public function isAdminOrLider()
    {

        return $this->type === 'admin' || $this->type === 'lider';
    }

    public function FichasAsignadas()
    {
        return $this->fichas->all();
    }

    public function getHorasAcumuladasAttribute()
    {
        $horas = $this->hasMany('\App\Evento')
            ->selectRaw('sum(horas) as horas')
            ->where('start', '>=', Carbon::now()->startOfMonth())//acumla solamente lo de este mes
            ->groupBy('user_id')
            ->get();
        //dd($horas->all()->horas);
        return $horas;
    }
}
