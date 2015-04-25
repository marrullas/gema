<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('first_name', null, [ 'class' => 'form-control', 'placeholder' => 'Digite el nombre' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('apellido', 'Apellido') !!}
    {!! Form::text('last_name', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese el apellido' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('telefono1', 'Telefono celular') !!}
    {!! Form::text('telefono1', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese telefono de contacto' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('telefono2', 'Telefono fijo') !!}
    {!! Form::text('telefono2', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese telefono fijo' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'E-Mail o correo electronico') !!}
    {!! Form::text('email', null, [ 'class' => 'form-control', 'placeholder' => 'Ingrese el email' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('passwprd', 'Contraseña ') !!}
    {!! Form::password('password', [ 'class' => 'form-control', 'placeholder' => 'Ingrese su contraseña' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('type', 'Tipo de usuario ') !!}
    {!! Form::select('type',config('options.types'), null, [ 'class' => 'form-control', 'placeholder' => 'Escoja el tipo de usuario' ] ) !!}
</div>