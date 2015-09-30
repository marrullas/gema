{!! Form::open(['route'=> ['admin.entregas.destroy',$entrega], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger">Eliminar entrega</button>
{!! Form::close() !!}