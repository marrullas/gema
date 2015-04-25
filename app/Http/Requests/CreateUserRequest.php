<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'first_name'=>'required',
            'last_name'=>'required',
            'telefono1'=>'required',
            'telefono2'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'type'=>array('required','in:user,admin,instructor,ie,lider')
			//
		];
	}

}
