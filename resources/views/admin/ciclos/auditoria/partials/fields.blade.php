<div class="form-group">
    {!! Form::label('actividad', 'Actividad') !!}
    {!! Form::label('actividad', $auditoria->actividad->nombre) !!}
    {!! Form::hidden('auditoria_id', $auditoria->id) !!}
    {!! Form::hidden('user_id', $auditoria->usuariosxciclo->user_id) !!}
    {{--{!! Form::select('title',null,null,['class'=> 'form-control', 'placeholder' => 'Escoja tipo de actividad' ])!!}--}}
</div>
<div class="form-group">
    {!! Form::label('caracterizacion', 'Caraterización') !!}
    {!! Form::select('caracterizarncs_id',$caracterizarnc,null,['class'=> 'form-control', 'placeholder' => 'Escoja caracterizacion' ])!!}
</div>
<div class="form-group">
    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::textarea('descripcion', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    {!! Form::label('tiponcs', 'Tipo') !!}
    {!! Form::select('tiposnc_id',$tiposnc,null,['class'=> 'form-control', 'placeholder' => 'Escoja tipo de actividad' ])!!}
</div>
<div class="form-group">
    {!! Form::label('medida', 'Medida de acción') !!}
    {!! Form::textarea('medida', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    {!! Form::label('usuario', 'Responsable ') !!}
    {!! Form::select('user_id', $usuarios, $auditoria->usuariosxciclo->user_id, [ 'class' => 'form-control', 'disabled'=>'disabled'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('plazo', 'Plazo') !!}
    <div class="input-group date" id="datetimepicker1">
        {!! Form::text('plazo', null, ['class' => 'form-control', 'required'=>'" "']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.0/moment-with-locales.min.js"></script>
    {!! HTML::script('/bower_resources/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
    {!!Html::style('/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}
    <script type="text/javascript">
        $(function () {
            var plazo = null;
            @if(isset($nc))
                plazo = '{{$nc->plazo}}';
            @endif
            $('#datetimepicker1').datetimepicker({
                locale: 'es',
                format: 'DD/MM/YYYY',
                sideBySide: true,
                date: plazo

            });
        });
    </script>
@endsection

