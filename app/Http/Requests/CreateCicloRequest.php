<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCicloRequest extends Request
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
        return [
            //
            'nombre'=>'required|unique:ciclos',
            'fecha_ini'=>'required'

        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'Debe ingresar el nombre del ciclo',
            'nombre.unique' => 'El ciclo no debe ser repetido',
            'fecha_ini.required' => 'Debe ingresar la fecha inicial',
        ];
    }
}
