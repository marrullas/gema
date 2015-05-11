<?php namespace App\Http\Controllers\Admin;

use App\ciudad;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ie;
use Illuminate\Http\Request;

class IeController extends Controller {


    protected $request;

    function __construct(\Illuminate\Http\Request $request)
    {
        // TODO: Implement __construct() method.
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
        $nombre = $this->request->get('nombre');
        $page = $this->request->get('page');
        $ies = Ie::filtroPaginación($nombre);
        return view('admin.ies.index',compact('nombre','page','ies'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $ciudades = Ciudad::lists('full_name','codigo');


        return view('admin.ies.create',compact('ciudades'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\CreateIeRequest $request)
    {
        //
        $data = $request->all();

        $ie = new Ie($data);
        $ie->save();
        return redirect()->route('admin.ies.index');
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
        $ciudades = Ciudad::lists('full_name','codigo');
        $ie = Ie::findOrFail($id);
        return view('admin.ies.edit',compact('ie','ciudades'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\EditIeRequest $request, $id)
    {
        //
        $ie = Ie::findOrfail($id);
        $ie->fill($request->all());
        $ie->save();
        return redirect()->back();

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


}
