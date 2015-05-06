@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar programa</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($programa,['route'=> ['admin.programas.update', $programa], 'method' => 'PUT' ]) !!}
                        @include('admin.programas.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar programa
                        </button>
                        {!! Form::close() !!}
                        @include('admin.programas.partials.delete')


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
