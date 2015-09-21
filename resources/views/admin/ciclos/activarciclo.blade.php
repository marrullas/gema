@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar ciclo</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($ciclo,['route'=> ['admin.ciclos.storeambitoxciclo', $ciclo], 'method' => 'POST' ]) !!}
                            @include('admin.ciclos.partials.fieldsie')

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Actualizar datos
                        </button>
                        </div>
                        <p class="help-block">* Al actualizar los datos se actualiza el usuario responsable si este se ha modificado.</p>
                        {!! Form::close() !!}


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
