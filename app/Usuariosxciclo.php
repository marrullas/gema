<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuariosxciclo extends Model
{
    //
    protected $table = "usuariosxciclo";
    protected $fillable = ['user_id','ciclo_id','disponible','autogestion',
                            'iniciado','finalizado','descripcion','fechaini',
                            'fechafin'];
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function ciclo()
    {
        return $this->belongsTo('\App\Ciclo');
    }
    public function auditoria()
    {
        return $this->hasMany('\App\Auditoria');
    }
}
