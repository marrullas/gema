<?php namespace App\Http\Controllers;

use App\Muro;

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

        $entradasMuro = Muro::getEntradas();
        $anunciosMuro = Muro::getAnuncios();
        $user = \Auth::user();

        //dd($entradasMuro);

        switch($user->type)
        {
            case 'admin':
                return view('admin.users.home',compact('entradasMuro','anunciosMuro','user'));
            break;
            case 'user':
                return view('user.home',compact('entradasMuro','anunciosMuro','user'));
            case 'instructor':
                return view('instructor.home',compact('entradasMuro','anunciosMuro','user'));
            default:
                 return view('auth.login');


        }


   /*     if(\Auth::user()->type == 'admin')
            return view('admin.users.home');
        else
            return view('home');*/
	}

}
