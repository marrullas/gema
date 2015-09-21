<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('nit', 'Nit') !!}
    {!! Form::text('nit', null, [ 'class' => 'form-control', 'placeholder' => 'Digite Nit' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('tipo', 'Tipo de Institución ') !!}
    {!! Form::select('tipo',config('options.tiposie'), null, [ 'class' => 'form-control', 'placeholder' => 'Escoja el tipo' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('modalidad', 'Modalidad de Institución ') !!}
    {!! Form::select('modalidad',config('options.modalidad'), null, [ 'class' => 'form-control', 'placeholder' => 'Escoja modalidad' ] ) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Correo electronico') !!}
    {!! Form::text('email', null, [ 'class' => 'form-control', 'placeholder' => 'Digite correo' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('ciudad_id', 'Ciudad') !!}
    {!! Form::select('ciudad_id', $ciudades, null, [ 'class' => 'form-control'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('direccion', 'Dirección') !!}
    {!! Form::text('direccion', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese dirección' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('telefono', 'Teléfono') !!}
    {!! Form::text('telefono', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese Telefono' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('nombre_rector', 'Nombre rector I.E') !!}
    {!! Form::text('nombre_rector', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese nombre rector' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('email_rector', 'Correo rector I.E') !!}
    {!! Form::text('email_rector', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese email rector' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('tel_rector', 'Teléfono rector I.E') !!}
    {!! Form::text('tel_rector', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese teléfono rector' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('mapa', 'Mapa') !!}
    {!! Form::text('mapa', null, [ 'class' => 'form-control', 'disabled','placeholder' => 'Ingrese coordenadas google Maps' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('usuario', 'Usuario') !!}
    {!! Form::select('user_id', $usuarios, null, [ 'class' => 'form-control selectpicker','data-live-search="true"'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('detalles', 'Detalles / Observaciones') !!}
    {!! Form::textarea('detalles', null,['class'=>'form-control textarea'])!!}
</div>
@section('scripts')
    {!! HTML::script('/bower_resources/bootstrap-select/js/bootstrap-select.js') !!}
    {!! HTML::script('/bower_resources/bootstrap-select/js/i18n/defaults-es_CL.js') !!}
    {!!Html::style('/bower_resources/bootstrap-select/css/bootstrap-select.min.css')!!}

    <script type="application/javascript">
        $('.selectpicker').selectpicker();
    </script>
@endsection