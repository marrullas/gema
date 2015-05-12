<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ciudad extends Model {

	//

    protected $table = 'ciudades';


    public function ies()
    {
        return $this->hasMany('\App\Ie');
    }

}
