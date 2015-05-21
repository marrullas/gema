@extends('app')
@section('menu')
    @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

        @include('instructor.partials.menu')
    @else

        @include('admin.partials.menu')

    @endif
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Enviar mensaje </div></h3>

                     <div class="panel-body ">
                        <h4>Tu mensaje ha sido enviado, Gracias por participar.</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
