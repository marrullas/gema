<table class="table table-user-information">
    <tbody>
    <tr>
        <td>Actividad:</td>
        <td>{!! $entrega->actividad->nombre !!}</td>
    </tr>
    <tr>
        <td>ciclo:</td>
        <td>{!! $entrega->ciclo->nombre !!}</td>
    </tr>
    </tbody>
</table>
<div class="form-group">
    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::textarea('descripcion', null,['class'=>'form-control textarea'])!!}
</div>
<div class="form-group">
    {!! Form::label('numeroarchivos', 'Numero archivos') !!}
    {!! Form::text('numeroarchivos', null, ['placeholder' => 'Digite numero numero archivos' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('fecha', 'Fecha entrega') !!}
    <div class="input-group date" id="datetimepicker1">
        {!! Form::text('fecha', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('documento_id', 'Dococumentos') !!}
    {!! Form::select('documento_id', $documentos, $documento, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
</div>



@section('scripts')
    {!! HTML::script('/bower_resources/bootstrap-select/js/bootstrap-select.js') !!}
    {!! HTML::script('/bower_resources/bootstrap-select/js/i18n/defaults-es_CL.js') !!}
    {!!Html::style('/bower_resources/bootstrap-select/css/bootstrap-select.min.css')!!}
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
                date: '{{$entrega->fecha}}'

            });

        });
    </script>
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection