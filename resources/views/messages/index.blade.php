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
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="chat-panel panel panel-default chat-boder chat-panel-head " >
                        <div class="panel-heading bg-color-green">
                            <i class="fa fa-comments fa-fw "></i>
                            Recibidos
                        </div>

                        <div class="panel-body">
                            @include('admin.partials.messages')
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th class="span1"><input type="checkbox"></th>
                                    <th class="span2"></th>
                                    <th class="span2"></th>
                                    <th class="span9"></th>
                                    <th class="span2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mensajes as $mensaje)
                                    @if($mensaje->status != 'leido')
                                        <tr>
                                            <td><input type="checkbox">
                                                @if($mensaje->user_id == $userID)

                                                    <i class="fa fa-arrow-circle-o-up"></i>
                                                @else
                                                    <i class="fa fa-arrow-circle-down"></i>
                                                    @endif
                                                <a href="{{ route('message.show',$mensaje) }}"><i class="fa fa-eye-slash"></i></a>
                                            </td>
                                            <td><strong>{{$mensaje->user->full_name}}</strong></td>
                                            <td><strong>{{$mensaje->receptor->full_name}}</strong></td>
                                            @if($mensaje->respuesta)
                                            <td><span class="label label-info pull-right">{{str_limit($mensaje->titulo,30)}}</span></td>
                                            @else
                                                <td><span class="label label-warning pull-right">{{str_limit($mensaje->titulo,30)}}</span></td>
                                            @endif
                                            <td><strong>{{str_limit($mensaje->contenido,30)}}</strong></td>
                                            <td><strong>{{$mensaje->created_at}}</strong></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td><input type="checkbox">
                                                @if($mensaje->user_id == $userID)

                                                    <i class="fa fa-arrow-circle-o-up"></i>
                                                @else
                                                    <i class="fa fa-arrow-circle-down"></i>
                                                @endif
                                                <a href="{{ route('message.show',$mensaje) }}"><i class="fa fa-eye"></i></a>
                                            </td>
                                            <td>{{$mensaje->user->full_name}}</td>
                                            @if($mensaje->respuesta)
                                                <td><span class="label label-info pull-right">{{str_limit($mensaje->titulo,30)}}</span></td>
                                            @else
                                                <td><span class="label label-warning pull-right">{{str_limit($mensaje->titulo,30)}}</span></td>
                                            @endif
                                            <td>{{str_limit($mensaje->contenido,30)}}</td>
                                            <td>{{$mensaje->created_at}}</td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>

                <!-- /. ROW  -->

                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->

        @endsection


        @section("scripts")


            {!! HTML::script('/css/assets/js/custom.js') !!}
            {{--{!! HTML::script('/bower_resources/wysihtml5x/dist/wysihtml5x-toolbar.min.js') !!}--}}





@endsection
