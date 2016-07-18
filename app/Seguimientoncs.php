<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimientoncs extends Model
{
    //
    protected $table = 'seguimientoncs';
    protected $fillable = ['ncs_id','user_id','detalle','estadoncs_id'];

    public function ncs()
    {
        return $this->belongsTo('\App\Ncs');
    }
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
