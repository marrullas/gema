<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    //
    protected $fillable = ['id','titulo','contenido','status','sendmail','user_id','destinatario','destinatarios','enviar','respuesta'];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
