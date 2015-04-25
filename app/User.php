<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

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
	protected $fillable = ['first_name', 'last_name', 'telefono1','telefono2', 'email', 'password', 'type', 'last_login'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function bio()
    {
        $this->hasOne('app\Bio');
    }

    public function eventos()
    {
        Return $this->hasMany('app\Evento');
    }


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * encripta la contraseña del usuario
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        /** @var TYPE_NAME $value */
        if(!empty($value))
            $this->attributes['password'] = bcrypt($value);
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
}
