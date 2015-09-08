<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateActaRequest extends Request
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
            'codigo'    =>'required|unique:fichas',
            'fecha_ini' =>'required',
            'user_id'   =>'required',
            'estado'    =>'required',
            'ie_id'     =>'required',
            'programa_id'   =>'required'

        ];
    }
}
