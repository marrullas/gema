{!! Form::open(['route'=> ['admin.fichas.destroy',$ficha], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger">Eliminar </button>
{!! Form::close() !!}