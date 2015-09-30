@extends('app')
@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar Entrega</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($entrega,['route'=> ['admin.entregas.update', $entrega], 'method' => 'PUT' ]) !!}
                        @include('admin.entregas.partials.fields')
                        <div class="form-group" data-toggle="buttons">
                        <button type="submit" class="btn btn-primary">Actualizar entrega
                        </button>
                        {!! Form::close() !!}
                        @include('admin.entregas.partials.delete')
                            </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
