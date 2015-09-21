<div class="form-group">
    {!! Form::label('nombre', 'Ciclo') !!}
    {!! Form::text('nombre', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('descripcion', 'Decripción') !!}
    {!! Form::textarea('descripcion', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    {!! Form::label('ambito_id', 'Ambito') !!}
    {!! Form::select('ambito_id', $ambitos, null, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('procedimiento_id', 'Procedimiento') !!}
    {!! Form::select('procedimiento_id', $procedimientos, null, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('fecha_ini', 'Fecha inicial') !!}
    <div class="input-group date" id="datetimepicker1">
        {!! Form::text('fecha_ini', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>

<div class="form-group">
    {!! Form::label('fecha_fin', 'Fecha final') !!}
    <div class="input-group date" id="datetimepicker2">
        {!! Form::text('fecha_fin', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('activo', 'Activo') !!}
    {!! Form::checkbox('activo', 1, $ciclo->activo) !!}
</div>

@section("scripts")
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.0/moment-with-locales.min.js"></script>
    {!! HTML::script('/bower_resources/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
    {!!Html::style('/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}


    <script type="text/javascript">
        $(function () {

            $('#datetimepicker1').datetimepicker({
                locale: 'es',
                format: 'DD/MM/YYYY',
                sideBySide:true,
                showClear:true,
                date: '{{$ciclo->fecha_ini}}'

            });
            $('#datetimepicker2').datetimepicker({
                locale: 'es',
                format: 'DD/MM/YYYY',
                sideBySide:true,
                showClear:true

            });

        });
    </script>
    {!! HTML::script('/css/assets/js/custom.js') !!}



@endsection
