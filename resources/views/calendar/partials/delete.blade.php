{!! Form::open(['route'=> ['calendar.destroy',$evento], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger">Eliminar Evento</button>
{!! Form::close() !!}