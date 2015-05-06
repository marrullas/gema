<?php namespace App\Http\Requests;

use App\Ficha;
use App\Http\Requests\Request;

class EditFichaRequest extends Request {

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
        $ficha = Ficha::find($this->fichas);

        //dd($ficha->codigo);
		return [
			//
            'codigo'    =>'required|unique:fichas,codigo,'. $ficha->id, //permite ignorar el propio registro
            'fecha_ini' =>'required',
            'user_id'   =>'required',
            'estado'    =>'required',
            'ie_id'     =>'required',
            'programa_id'   =>'required'

		];
	}

}
