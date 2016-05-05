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
                    <div class="panel-heading"><h3>Editar IE</h3></div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($ie,['url'=> ['ies/updateie',$ie]]) !!}

                        @include('users.ies.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar IE
                        </button>
                        {!! Form::close() !!}
                        {{--@include('admin.ies.partials.delete')--}}


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section("scripts")


    {!! HTML::script('/css/assets/js/custom.js') !!}


@endsection