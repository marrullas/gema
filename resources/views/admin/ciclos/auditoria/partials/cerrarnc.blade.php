
<!-- Modal -->
<div class="modal fade" id="myModalcerrarnc{{$nc->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cerrar hallazgo: <b>{!! $nc->descripcion !!}</b></h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route'=> ['ncs.update',$nc], 'method' => 'PUT','files' => true ] ) !!}
{{--                    <div class="form-group">
                        {!! Form::label('Evidencia') !!}
                        {!! Form::file('file', null) !!}
                        {!! Form::hidden('codigo', $codigo) !!}
                        {!! Form::hidden('prefijo', $prefijo) !!}
                    </div>--}}
                    <div class="form-group">
                        {!! Form::hidden('estadoncs_id', 3) !!}
                        {!! Form::label('devolucion', 'Nota para cerrar') !!}
                        {!! Form::textarea('detalles', null,['class'=>'form-control textarea'])!!}
                    </div>

{{--
                <div class="btn-group">

                </div>
--}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" onclick="return confirm('Esta seguro que quiere cerrar este hallazgo?')" class="btn btn-success btn-sm"><i class="fa fa-trash-o"></i> Cerrar Hallazgo</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div> <!-- Fin moda -->