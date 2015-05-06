{!! Form::open(['route'=> ['admin.programas.destroy',$programa], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este usuario?')" class="btn btn-danger">Eliminar programa</button>
{!! Form::close() !!}