<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller {

    protected $request;
    function __construct(\Illuminate\Http\Request $request)
    {
        // TODO: Implement __construct() method.

        //$this->middleware('auth');
        $this->request = $request;


    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        return view('contact');
	}

    public function feedback()
    {
        return view('emails.feedback');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function send(Request $request)
    {
        //guarda el valor de los campos enviados desde el form en un array
        $data = $request->all();

        //se envia el array y la vista lo recibe en llaves individuales {{ $email }} , {{ $subject }}...
        \Mail::send('emails.message', $data, function($message) use ($request)
        {
        //remitente
            $message->from($request->email, $request->name);

            //asunto
            if(!Auth::check())
                $message->subject($request->subject);
            else
                $message->subject('feedback - '.$request->subject); //marco el mensaje como feedback

            //receptor
            $email = 'marrullas@gmail.com';
            $contacto = 'Admin';

            //$message->to(env('CONTACT_MAIL'), env('CONTACT_NAME'));
            $message->to($email, $contacto);

        });
        if(!Auth::check())
            return \View::make('emails.success');

        return \View::make('emails.successfb');
    }

    public function SendMessage()
    {
        //guarda el valor de los campos enviados desde el form en un array
        //$data = $request->all();
        $user = User::findOrFail(Auth::user()->id);
        //se envia el array y la vista lo recibe en llaves individuales {{ $email }} , {{ $subject }}...
        \Mail::send('emails.message', ['user'=>$user], function($message) use ($user)
        {
            //remitente
            $message->from($user->email2, $user->full_name);

            //asunto
/*            if(!Auth::check())
                $message->subject($request->subject);
            else*/
                $message->subject('feedback - esto es una prueba'); //marco el mensaje como feedback

            //receptor
            $email = 'marrullas@gmail.com';
            $contacto = 'Admin';

            //$message->to(env('CONTACT_MAIL'), env('CONTACT_NAME'));
            $message->to($email, $contacto);

        });
/*        if(!Auth::check())
            return \View::make('emails.success');

        return \View::make('emails.successfb');*/
    }





}
