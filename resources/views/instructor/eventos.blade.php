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
                    <div class="panel-heading"><h3>Lista eventos instructor: <b>{{$user->full_name}}</b></h3></div>

                    <div class="panel-body">
                        <a class="btn btn-success btn-xs" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/agendaexcel/'.$user->id) }}">Exportar excel</a>
                        @include('instructor.partials.tableedit')


                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection


@section("scripts")


    {{--{!! HTML::script('/css/assets/js/custom.js') !!}--}}
    {{--{!! HTML::script('/bower_resources/wysihtml5x/dist/wysihtml5x-toolbar.min.js') !!}--}}





@endsection
