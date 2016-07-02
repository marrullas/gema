<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Illuminate\Routing\Route;

class EditUserRequest extends Request {
    /**
     * @var Route
     */
    private $route;


    /**
     * @param Route $route
     */
    public function __construct(Route $route)
    {

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
         $user = $this->route('users');
        return [
            //
            'first_name' => 'required',
            'last_name' => 'required',
            //'documento' => 'required|unique:users,documento,' . $this->user()->id,
            'documento' => 'required|unique:users,documento,' . $user,

            'telefono1' => 'required',
            'telefono2' => 'required',
            //'email' => 'required|unique:users,email,' . $this->route->getParameter('users'),
            'email' => 'required|unique:users,email,' . $user,
            'email2' => 'required|unique:users,email2,' . $user,
            'password' => '',
            'type' => 'required|in:user,admin,instructor,ie,lider,auditor'
        ];
	}

}
