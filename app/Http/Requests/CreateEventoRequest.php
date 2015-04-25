<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateEventoRequest extends Request {

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
        //soluciona problema del checkbox vacio
        $this->merge(['all_day' => $this->input('all_day', 0)]);

        return [
            'title' => 'required',
            'start' => 'required',
            'end'   => 'required',
		];
	}

}
