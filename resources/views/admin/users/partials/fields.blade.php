<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('first_name', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('apellido', 'Apellido') !!}
    {!! Form::text('last_name', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese el apellido' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('documento', '# Documento') !!}
    {!! Form::text('documento', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese numero de documento' ] ) !!}
</div>

<div class="form-group">
    {!! Form::label('telefono1', 'Telefono celular') !!}
    {!! Form::text('telefono1', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese telefono de contacto' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('telefono2', 'Telefono fijo') !!}
    {!! Form::text('telefono2', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese telefono fijo' ] ) !!}
</div>
@if(Auth::user()->isAdminOrLider())
<div class="form-group">
    {!! Form::label('email', 'E-Mail o correo electronico') !!}
    {!! Form::text('email', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese el email principal' ] ) !!}
</div>
@else
    <div class="form-group">
        {!! Form::label('email', 'E-Mail o correo electronico') !!}
        {!! Form::text('email', null, [ 'class' => 'form-control','disabled', 'placeholder' => 'Ingrese el email principal' ] ) !!}
        {!! Form::hidden('email',null) !!}
    </div>

@endif
<div class="form-group">
    {!! Form::label('email2', 'E-Mail o correo electronico secudario') !!}
    {!! Form::text('email2', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese el email secundario' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('titulo', 'Titulo academico') !!}
    {!! Form::text('titulo', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese titulol' ] ) !!}
</div>

<div class="form-group">
    {!! Form::label('profesion', 'Profesión') !!}
    {!! Form::text('profesion', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese Profesion' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('fecha_nac', 'Fecha de nacimiento') !!}
    {!! Form::text('fecha_nac', null, [ 'class' => 'form-control','disabled', 'placeholder' => 'Ingrese fecha nacimientol' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('ciudad', 'Ciudad') !!}
    {!! Form::select('ciudad', $ciudades, null, [ 'class' => 'form-control'] ) !!}
</div>
@if(Auth::User()->isAdminOrLider())
<div class="form-group">
    {!! Form::label('passwprd', 'Contraseña ') !!}
    {!! Form::password('password', [ 'class' => 'form-control', 'placeholder' => 'Ingrese su contraseña' ] ) !!}
</div>

<div class="form-group">
    {!! Form::label('type', 'Tipo de usuario ') !!}
    {!! Form::select('type',config('options.types'), null, [ 'class' => 'form-control', 'placeholder' => 'Escoja el tipo de usuario' ] ) !!}

</div>

<div class="form-group">
    {!! Form::label('active', 'Activo') !!}
    {!! Form::checkbox('active', 1, $active) !!}
</div>
{{--@else
    <div class="form-group">
        {!! Form::label('type', 'Tipo de usuario ') !!}
        {!! Form::select('type',config('options.types'), null, [ 'class' => 'form-control', 'disabled', 'placeholder' => 'Escoja el tipo de usuario' ] ) !!}
        {!! Form::hidden('type',null) !!}
    </div>--}}

@endif

