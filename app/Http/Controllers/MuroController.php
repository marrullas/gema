<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Muro;
use Illuminate\Http\Request;

/**
 * @property  request
 */
class MuroController extends Controller {


    protected $request;

    function __construct(\Illuminate\Http\Request $request)
    {
        // TODO: Implement __construct() method.
        $this->middleware('auth');
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

        dd('por aqui vamos');
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

    /**
     *funcion que se encarga de almacenar un mensaje la tabla de anuncios
     */
    public function crearmuro(){

        $data = $this->request->all();

        $muro = new Muro($data);
        $muro->user_id = $this->request->user()->id;
        $muro->save();

        return redirect()->back();


    }
    /**
     *funcion que se encarga de almacenar un mensaje la tabla de anuncios
     */
    public function crearanuncio(){

        $data = $this->request->all();

        $muro = new Muro($data);
        $muro->user_id = $this->request->user()->id;
        $muro->tipo = 'anuncio';
        $muro->save();

        return redirect()->back();


    }

}
