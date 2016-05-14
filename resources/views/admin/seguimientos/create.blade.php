@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Nuevo Seguimiento</div>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::open(['route'=> 'admin.seguimientos.store', 'method' => 'POST' ]) !!}
                        @include('admin.seguimientos.partials.fields')

                        <button type="submit" class="btn btn-default">Crear
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
