<div class="form-group">
 {{--   {!! Form::label('nombre', 'Ciclo: ') !!}
    {!! Form::text('nombre', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre' ] ) !!}
    {!! Form::label('procedimiento_id', $ciclo->nombre) !!}--}}
    {!! Form::hidden('ciclo_id',$ciclo->id) !!}
    <table class="table table-user-information">
        <tbody>
        <tr>
            <td>Ciclo:</td>
            <td>{!! $ciclo->nombre !!}</td>
        </tr>
        <tr>
            <td>Ambito:</td>
            <td>{!! $ciclo->ambito->nombre !!}</td>
            {!! Form::hidden('ambito_id',$ciclo->ambito->id) !!}
        </tr>
        <tr>
            <td>Procedimiento:</td>
            <td>{!! $ciclo->procedimiento->nombre !!}</td>
        </tr>
        </tbody>
        </table>
</div>
{{--<div class="form-group">
    {!! Form::label('ambito_id', 'Ambito: ') !!}
    {!! Form::label('ambito_id', $ciclo->ambito->nombre) !!}
    {!! Form::select('ambito_id', $ambitos, null, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
</div>--}}
{{--<div class="form-group">
    {!! Form::label('procedimiento_id', 'Procedimiento: ') !!}
    {!! Form::label('procedimiento_id', $ciclo->procedimiento->nombre) !!}
    --}}{{--{!! Form::select('procedimiento_id[]', $procedimientos, null, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}--}}{{--
</div>--}}
<div class="row">

    <div class="col-xs-5">
        <b>Inactivos</b>

        {!! Form::select('inactivos[]', $datos, null, [ 'class' => 'form-control', 'multiple'=>'multiple','size'=>'8','id'=>'multiselect'] ) !!}
    </div>
    <div class="col-xs-2">
        <b>Acciones</b>
        <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
        <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
        <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
        <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
    </div>
    <div class="col-xs-5">
        <b>Activos</b>
        {{--<select name="entidades[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
        </select>--}}
        {!! Form::select('entidades[]', $datos2, null, [ 'class' => 'form-control', 'multiple'=>'multiple','size'=>'8','id'=>'multiselect_to'] ) !!}

    </div>
</div> <!--ROW !-->
<div class="form-group">
</div>
@section("scripts")
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.0/moment-with-locales.min.js"></script>
    {!! HTML::script('/bower_resources/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
    {!!Html::style('/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}

    {!! HTML::script('/bower_resources/multiselect-two-sides/js/multiselect.min.js') !!}
    {!!Html::style('/bower_resources/multiselect-two-sides/css/style.css')!!}
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
            $('#multiselect').multiselect();
        });


    </script>
    {!! HTML::script('/css/assets/js/custom.js') !!}



@endsection
