<div class="form-group">
    {!! Form::label('nombre', 'Procedimiento') !!}
    {!! Form::text('nombre', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('version', 'Version') !!}
    {!! Form::text('version', null, [ 'class' => 'form-control', 'placeholder' => 'Digite la versión' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('codigo', 'Codigo') !!}
    {!! Form::text('codigo', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el codigo' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('vigencia', 'Vigencia') !!}
    <div class="input-group date" id="datetimepicker1">
        {!! Form::text('vigencia', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('proceso', 'Proceso') !!}
    {!! Form::text('proceso', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el proceso' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('objetivo', 'Objetivo') !!}
    {!! Form::textarea('objetivo', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    {!! Form::label('responsable', 'Responsable') !!}
    {!! Form::textarea('responsable', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    {!! Form::label('alcance', 'Alcance') !!}
    {!! Form::textarea('alcance', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    {!! Form::label('generalidades', 'Generalidades') !!}
    {!! Form::textarea('generalidades', null,['class'=>'form-control textarea'])!!}
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
                date: '{{$procedimiento->vigencia}}'

            });

        });
    </script>
    {!! HTML::script('/css/assets/js/custom.js') !!}



@endsection
