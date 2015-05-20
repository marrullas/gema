<?php namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
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
            ->orderBy('id','ASC')
            ->paginate();
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
