{!! Form::open(['route'=> ['message.destroy',$mensaje], 'method' => 'DELETE' ]) !!}
<p class="text-right"><button type="submit" onclick="return confirm('Esta seguro que quiere eliminar este mensaje?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Eliminar</button></p>

{!! Form::close() !!}