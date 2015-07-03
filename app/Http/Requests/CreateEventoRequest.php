<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\carbon;

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
        if(!empty($this->input('start') && !empty($this->input('end')))) {
            $fechastart = carbon::createFromFormat('d/m/Y H:i', $this->input('start'));
            $fechasend = carbon::createFromFormat('d/m/Y H:i', $this->input('end'));


            //dd($fechasend);
            return [
                'title' => 'required',
                'start' => 'required|solapada:' . $this->input('ficha_id') . ',' . $fechastart .
                    ',' . $fechasend .
                    ',' . $this->input('all_day'),

                /*            'start' => 'required|solapada:'. $this->input('ficha_id').','.new \Carbon\carbon($this->input('start')).
                                ','.new \Carbon\carbon($this->input('end')).
                                ','.$this->input('all_day'),*/
                //'start' => 'required',
                'end' => 'required|end_after:start',
            ];
        }
        return [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];


	}

    public function messages()
    {
        return [
            'start.solapada' => 'Hora solapada',
            'title.required' => 'Debe ingresar el tipo de actividad',
            'start.isweekend' => 'no esta permitido programar horas los fines de semana',
            'end.end_after'=>'Hora final no debe ser menor que la hora inicial',
        ];
    }

}
