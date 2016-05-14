<div class="form-group">
    {!! Form::label('usuaria', 'Usuario ') !!}
    {!! Form::select('user_id_seguimiento', $usuarios, null, [ 'class' => 'form-control'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion') !!}
    {!! Form::text('descripcion', null, [ 'class' => 'form-control', 'placeholder' => 'Digite descripcion del seguimiento' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('detalles', 'Detalles / Observaciones') !!}
    {!! Form::textarea('detalles', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    {!! Form::label('estado_segumiento', 'Estado') !!}
    {!! Form::select('estadoseguimientos', $estadoseguimiento, null, [ 'class' => 'form-control'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('fecha_entrega', 'Fecha/Hora entrega') !!}
    <div class="input-group date" id="datetimepicker1">
        {!! Form::text('fecha_entrega', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.0/moment-with-locales.min.js"></script>
    {!! HTML::script('/bower_resources/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
    {!!Html::style('/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}
    <script type="text/javascript">
        $(function () {

            $('#datetimepicker1').datetimepicker({
                locale: 'es',
                format: 'DD/MM/YYYY HH:mm',
                sideBySide: true

            });
        })
    </script>
@endsection