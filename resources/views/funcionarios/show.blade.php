@extends('app')

@section('menu')
    @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

        @include('instructor.partials.menu')
    @else

        @include('admin.partials.menu')

    @endif
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Datos Funcionario</div>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        @include('funcionarios.partials.profile')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
