@extends('app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar usuario</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($user,['route'=> ['admin.users.update', $user], 'method' => 'PUT' ]) !!}
                        @include('admin.users.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar usuario
                        </button>
                        {!! Form::close() !!}
                        @include('admin.users.partials.delete')


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
