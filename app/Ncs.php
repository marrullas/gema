<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ncs extends Model
{
    //
    protected $table = 'ncs';
    protected $fillable = ['auditoria_id','user_id','auditor','certificador',
                            'estadoncs_id','descripcion','tiposnc_id','medida','plazo'];


    public function setPlazoAttribute($value)
    {
        $fecha =  \Carbon\carbon::createFromFormat('d/m/Y',$value);
        $this->attributes['plazo'] = $fecha;
    }
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function auditor()
    {
        return $this->belongsTo('\App\User');
    }
    public function certificador()
    {
        return $this->belongsTo('\App\User');
    }
    public function auditoria()
    {
        return $this->belongsTo('\App\Auditoria');
    }
    public function estadoncs()
    {
        return $this->belongsTo('\App\Estadosncs','estadoncs_id','id');
    }
    public function tiponc()
    {
        return $this->belongsTo('\App\Tiposnc','tiposnc_id','id');
    }
    public function seguimientos()
    {
        return $this->hasMany('\App\Seguimientoncs');
    }


    public function scopeNcsresueltas($query)
    {
        return $query->estadoncs()->where('nombre','=','Cerrada');
    }
    public function scopeNcspendientes($query)
    {
        return $query->estadoncs()->where('nombre','=','Abierta');
    }
}
