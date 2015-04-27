<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{

        switch(\Auth::user()->type)
        {
            case 'admin':
                return view('admin.users.home');
            break;
            case 'user':
                return view('user.home');
            case 'instructor':
                return view('instructor.home');
            default:
                 return view('auth.login');


        }


   /*     if(\Auth::user()->type == 'admin')
            return view('admin.users.home');
        else
            return view('home');*/
	}

}
