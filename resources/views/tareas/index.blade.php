@extends('app')

@section('menu')
    @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

        @include('instructor.partials.menu')
    @else

        @include('admin.partials.menu')

    @endif
@endsection
@section('content')
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">

            <div class="row">
                <div class="col-md-12">

                    <div class="row" >
                        <div class="col-md-9 col-sm-6 col-xs-6">
                        <div class="panel-heading bg-color-green">
                            <i class="fa fa-comments fa-fw "></i>
                            Tareas
                        </div>

                        <div class="panel-body">
                            @include('admin.partials.messages')
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th class="span1"><input type="checkbox"></th>
                                    <th class="span2">Solicita</th>
                                    <th class="span2">Resposanble</th>
                                    <th class="span9">Objetivo</th>
                                    <th class="span2">Descripción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tareas as $tarea)

                                    @if($tarea->estado)
                                        <tr>
                                            <td><input type="checkbox">
                                                @if($tarea->creador == $userID)

                                                    <i class="fa fa-arrow-circle-o-up"></i>
                                                @else
                                                    <i class="fa fa-arrow-circle-down"></i>
                                                    @endif
                                                <a href="{{ route('tarea.show',$tarea->tarea_id) }}"><i class="fa fa-eye-slash"></i></a>
                                            </td>
                                            <td><strong>{{$tarea->tarea->creadopor->full_name}}</strong></td>
                                            <td><strong>{{$tarea->responsable}}</strong></td>
                                            @if($tarea->descripcion)
                                            <td><span class="label label-info pull-right">{{str_limit($tarea->nombre,30)}}</span></td>
                                            @else
                                                <td><span class="label label-warning pull-right">{{str_limit($tarea->nombre,30)}}</span></td>
                                            @endif
                                            <td><strong>{{str_limit($tarea->descripcion,30)}}</strong></td>

                                        </tr>
                                    @else
                                        <tr>
                                            <td><input type="checkbox">
                                                <a href="{{ route('tareas.show',$tarea->tarea_id) }}"><i class="fa fa-clock-o"></i></a>
                                            </td>
                                            <td>{{$tarea->tarea->creadopor->full_name}}</td>
                                            <td><strong>{{$tarea->para->full_name}}</strong></td>
                                            @if($tarea->descripcion)
                                                <td><span class="label label-info pull-right">{{str_limit($tarea->nombre,30)}}</span></td>
                                            @else
                                                <td><span class="label label-warning pull-right">{{str_limit($tarea->nombre,30)}}</span></td>
                                            @endif
                                            <td>{{str_limit($tarea->descripcion,30)}}</td>

                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table

                        </div>

                        </div>

                 </div>  <!-- /. ROW  -->
                    @include("partials.sidebar")
                <!-- /. PAGE INNER  -->
            </div>

            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->

        @endsection


        @section("scripts")


            {!! HTML::script('/css/assets/js/custom.js') !!}
            {{--{!! HTML::script('/bower_resources/wysihtml5x/dist/wysihtml5x-toolbar.min.js') !!}--}}
                <!--AngularJS-->
                <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
                <script src="app/js/app.js"></script>







@endsection
