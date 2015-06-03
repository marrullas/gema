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
        //dd($this);
        //soluciona problema del checkbox vacio
        $this->merge(['all_day' => $this->input('all_day', 0)]);
        return [
            'title' => 'required',
            'start' => 'required|solapada:'.$this->input('ficha_id').','.$this->input('start').','.$this->input('end').','.$this->input('all_day'),
            //'start' => 'required',
            'end'   => 'required',
		];


	}

    public function messages()
    {
        return [
            'start.solapada' => 'Hora solapada',
            'title.required' => 'Debe ingresar el tipo de actividad',
            'start.isweekend' => 'no esta permitido programar horas los fines de semana',
        ];
    }

}
