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
                        <div class="panel-group">
                            <a class="btn btn-success btn-xs pull-right btn-sm RbtnMargin" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/agendaexcel/'.$user->id) }}">Exportar excel</a>
                            <div class="dropdown pull-right">
                                <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    Enlaces rapidos
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/calendar/'.$user->id) }}">Calendario</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/agenda/'.$user->id) }}">Agenda</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/actividades?userId='.$user->id) }}">Actividades</a></li>
                                </ul>
                            </div>
                        </div>
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
