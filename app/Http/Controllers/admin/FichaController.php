<?php namespace App\Http\Controllers\admin;

use App\Ficha;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\EditIeRequest;
use App\Ie;
use App\Programa;
use App\User;
use Illuminate\Http\Request;

/**
 * @property Request request
 */
class FichaController extends Controller {

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
        $codigo = $this->request->get('codigo');
        $ie = $this->request->get('ie');
        $page = $this->request->get('page');
        $fichas = Ficha::filtroPaginación($codigo,$ie);
        //dd($fichas->codigo);

        return view('admin.fichas.index',compact('codigo','page','fichas','ie'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $usuarios = User::lists('full_name','id');
        $ies = Ie::lists('nombre','id');
        $programas = Programa::lists('nombre','id');
        return view('admin.fichas.create',compact('usuarios','ies','programas'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateFichaRequest $request)
	{
		//
        $data = $request->all();

        $nombreIe = Ie::find($data['ie_id'])->nombre;

        $ficha = new Ficha($data);
        $ficha->full_name = $data['codigo'] . ' - ' . $nombreIe;
        $ficha->save();
        return redirect()->route('admin.fichas.index');


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
        $usuarios = User::lists('full_name','id');
        //dd($usuarios);
        $ies = Ie::lists('nombre','id');
        $programas = Programa::lists('nombre','id');
        $ficha = Ficha::findOrFail($id);
        return view('admin.fichas.edit',compact('ficha','usuarios','ies','programas'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests\EditFichaRequest $request, $id)
	{
		//

        //dd($request->all());
        $ficha = Ficha::findOrfail($id);
        $ficha->fill($request->all());
        $ie = Ie::find($ficha->ie_id);
        $ficha->full_name = $ficha->codigo . ' - ' . $ie->nombre;
        $ficha->save();
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
