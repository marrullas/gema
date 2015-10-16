@extends('app')
@section('menu')
    @include('menu.menu')
@endif
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar usuario</div></h3>

                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>


                    @endif

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($user,['route'=> ['users.update', $user], 'method' => 'PUT' ]) !!}
                        @include('admin.users.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar datos
                        </button>
                        {!! Form::close() !!}
                        @if($user->isAdminOrLider())
                            @include('admin.users.partials.delete')
                        @endif


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
