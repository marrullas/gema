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
            'first_name'=>'required',
            'last_name'=>'required',
            'documento'=>'required|unique:users',
            'telefono1'=>'required',
            'email'=>'required|unique:users,email',
            'email2'=>'required|unique:users,email2',
            'password'=>'required',
            'type'=>array('required','in:user,admin,instructor,ie,lider')
			//
		];
	}

}
