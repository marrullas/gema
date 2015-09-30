@extends('app')

@section('menu')
    @include('admin.partials.menu')
@endsection
@section('content')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Panel de control Instructor</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />


                    <!-- /. ROW  -->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">

                            <div class="chat-panel panel panel-default chat-boder chat-panel-head " >
                                <div class="panel-heading bg-color-green">
                                    <i class="fa fa-comments-o fa-5x"></i>
                                    <h4>Muro</h4>
                                </div>

                                <div class="panel-body">

                                    <ul class="chat-box">
                                        <?php $counter = 0; ?>
                                        @foreach($entradasMuro as $entradaMuro)

                                                @if($counter % 2 == 0)
                                            <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        {!! Html::image('/css/assets/img/1.png',null, ['class'=>'user-image img-circle']) !!}
                                    </span>
                                                @else
                                                    <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        {!! Html::image('/css/assets/img/2.png',null, ['class'=>'user-image img-circle']) !!}
                                    </span>
                                                        @endif
                                        <?php $counter++; ?>
                                                <div class="chat-body">
                                                    <strong >{{$entradaMuro->user->fullname}}</strong>
                                                    <small class="pull-right text-muted">
                                                        <i class="fa fa-clock-o fa-fw"></i>{{$entradaMuro->created_at}}
                                                    </small>
                                                    <p>
                                                        {!!$entradaMuro->mensaje!!}
                                                    </p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="panel-footer">
                                    {!! Form::Open(['url' => 'muro/crearmuro','method' => 'POST']) !!}
                                    <div class="form-group">
                                        {{--{!! Form::text('mensaje', null, [ 'class' => 'form-control input-sm', 'placeholder' => 'Escriba su mensaje...', 'id' => 'btn-input' ] ) !!}--}}
                                        {!! Form::textarea('mensaje', null,['class'=>'form-control textarea'])!!}
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">
                                                Enviar
                                            </button>
                                        </span>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                            </div>

                        </div>

                <!-- /. ROW  -->

                        <div class="row" >
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="chat-panel panel chat-boder chat-panel-head panel-primary no-boder">
                                    <div class="panel-heading bg-color-green">
                                        <i class="fa fa-comments-o fa-5x"></i>
                                        <h4>Anuncios</h4>
                                     </div>
                                    <div class="panel-body">
                                    <ul class="chat-box">

                                        @foreach($anunciosMuro as $anuncioMuro)
                                        <li class="clearfix">
                                        <i class="fa fa-rocket fa-5x"></i>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>{{$anuncioMuro->created_at}}
                                            </small>

                                            {!!$anuncioMuro->mensaje!!}


                                        </li>
                                        @endforeach
                                        <li class="left clearfix">
                                            <i class="fa fa-rocket fa-5x"></i>
                                            Por favor confirmar asistencia consectetur adipiscing elitsit sit gthn ipsum dolor sit amet ipsum dolor sit amet

                                        </li>
                                        </ul>

                                    </div>
                                    <div class="panel-footer">
                                        {!! Form::Open(['url' => 'muro/crearanuncio','method' => 'POST']) !!}
                                        <div class="form-group">
                                            {{--{!! Form::text('mensaje', null, [ 'class' => 'form-control input-sm', 'placeholder' => 'Escriba su mensaje...', 'id' => 'btn-input' ] ) !!}--}}
                                            {!! Form::textarea('mensaje', null,['class'=>'form-control textarea'])!!}
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">
                                                Enviar
                                            </button>
                                        </span>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /. ROW  -->
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

@endsection


@section("scripts")


    {{--{!! HTML::script('/css/assets/js/custom.js') !!}--}}
    {{--{!! HTML::script('/bower_resources/wysihtml5x/dist/wysihtml5x-toolbar.min.js') !!}--}}





@endsection