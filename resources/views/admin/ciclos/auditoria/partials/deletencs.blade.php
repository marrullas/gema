{!! Form::open(['route'=> ['ncs.destroy',$nc], 'method' => 'DELETE' ]) !!}
    <button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
{!! Form::close() !!}