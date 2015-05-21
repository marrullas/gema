@extends('app')

@section('menu')
    @include('instructor.partials.menu')
@endsection
@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Lista eventos instructor: <b>{{$user->full_name}}</b></div></h3>

                    <div class="panel-body">
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
