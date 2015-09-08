<?php

namespace App\Http\Requests;

use App\Actividad;
use App\Http\Requests\Request;

class EditActividadRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $actividad = Actividad::find($this->actividades);
       // dd($actividad);
        return [
            //
            'nombre'    =>'required',
            'orden'=>'required|unique:actividades,orden,'.$actividad->orden.',orden,procedimiento_id,'.$actividad->procedimiento_id,

        ];
    }
}
