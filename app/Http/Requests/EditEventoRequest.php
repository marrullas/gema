<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditEventoRequest extends Request {


    protected $route;

    function __construct(Route $route)
    {
        // TODO: Implement __construct() method.

        $this->route = $route;
    }
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
        $id = $this->route('calendar');
        $this->merge(['all_day' => $this->input('all_day', 0)]);
        return [
            'title' => 'required',
            //'start' => 'required',
            'start' => 'required|solapada:'.$this->input('ficha_id').','.$this->input('start').','.$this->input('end').','.$this->input('all_day').','.$id,
            'end'   => 'required'

        ];
	}



    public function messages()
    {
        return [
            'title.required' => 'Debe ingresar el tipo de actividad',
            'start.solapada' => 'Hora solapada',
        ];
    }

}
