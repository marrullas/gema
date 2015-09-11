

<div class="form-group">
    {!! Form::label('Archivo') !!}
    {!! Form::file('file', null) !!}
    {!! Form::hidden('codigo', $codigo) !!}
    {!! Form::hidden('prefijo', $prefijo) !!}
</div>
<div class="form-group">
    {!! Form::label('tipodocumento', 'Tipo archivo') !!}
    {!! Form::select('tipodocumento_id', $tipodocumentos, null, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::textarea('descripcion', null,['class'=>'form-control textarea'])!!}
</div>


@section('scripts')
    {!! HTML::script('/bower_resources/bootstrap-select/js/bootstrap-select.js') !!}
    {!! HTML::script('/bower_resources/bootstrap-select/js/i18n/defaults-es_CL.js') !!}
    {!!Html::style('/bower_resources/bootstrap-select/css/bootstrap-select.min.css')!!}
@endsection