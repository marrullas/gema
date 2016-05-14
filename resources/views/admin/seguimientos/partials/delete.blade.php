{!! Form::open(['route'=> ['admin.ies.destroy',$ie], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger">Eliminar IE</button>
{!! Form::close() !!}