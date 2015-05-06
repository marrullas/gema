@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar IE</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($ie,['route'=> ['admin.ies.update', $ie], 'method' => 'PUT' ]) !!}
                        @include('admin.ies.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar IE
                        </button>
                        {!! Form::close() !!}
                        @include('admin.ies.partials.delete')


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
