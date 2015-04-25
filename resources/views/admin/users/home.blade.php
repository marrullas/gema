@extends('app')

@section('content')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Panel de control Administrador</h2>
                        <h5>Bienvenido Instructor</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-envelope-o"></i>
                </span>
                            <div class="text-box" >
                                <p class="main-text">12 Nuevos</p>
                                <p class="text-muted">Mensajes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-bars"></i>
                </span>
                            <div class="text-box" >
                                <p class="main-text">7 Tareas</p>
                                <p class="text-muted">Pendientes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-bell-o"></i>
                </span>
                            <div class="text-box" >
                                <p class="main-text">24 Nuevas</p>
                                <p class="text-muted">Notificaciones</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                            <div class="text-box" >
                                <p class="main-text">3 Requerimientos</p>
                                <p class="text-muted">Pendientes</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue">
                    <i class="fa fa-warning"></i>
                </span>
                            <div class="text-box" >
                                <p class="main-text">52 Eventos para este mes </p>
                                <p class="text-muted">Por favor revise su calendario</p>
                                <hr />
                                <p class="text-muted">
                          <span class="text-muted color-bottom-txt"><i class="fa fa-edit"></i>
                               3 eventos importantes
                               </span>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel back-dash">
                            <i class="fa fa-dashboard fa-3x"></i><strong> &nbsp; Acumulado de horas</strong>
                            <p class="text-muted">Hasta este momento lleva registradas 96 horas de trabajo en las fichas asignadas. </p>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 ">
                        <div class="panel ">
                            <div class="main-temp-back">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i> Visitas semanales pendientes</div>
                                        <div class="col-xs-6">
                                            <div class="text-temp"> 3 </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                            {{--                    <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-green set-icon">
                                <i class="fa fa-desktop"></i>
                                </span>
                                <div class="text-box" >
                                <p class="main-text">Display</p>
                                <p class="text-muted">Looking Good</p>
                                </div>
                                 </div>--}}

                    </div>

                </div>
                <!-- /. ROW  -->
                <div class="row">


                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Comparativa
                            </div>
                            <div class="panel-body">
                                <div id="morris-bar-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>1 Encuesta </h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Encuestas

                            </div>
                        </div>
                       {{-- <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-edit fa-5x"></i>
                                <h3>20,000 </h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Articles Pending

                            </div>
                        </div>--}}
                    </div>

                </div>
                <!-- /. ROW  -->
                <div class="row" >
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-comments-o fa-5x"></i>
                                <h4>20 Nuevos Comentarios </h4>
                            </div>
                            <div class="panel-footer back-footer-green">
                                <i class="fa fa-rocket fa-5x"></i>
                                Por favor confirmar asistencia consectetur adipiscing elitsit sit gthn ipsum dolor sit amet ipsum dolor sit amet

                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Aprendices que deben cambiar de documento
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>ficha</th>
                                            <th>Fecha cumpleaños.</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Carlos Antonio Velez</td>
                                            <td>950101654897</td>
                                            <td>755542</td>
                                            <td>Ene/01/1995</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>William Vinasco</td>
                                            <td>950101654897</td>
                                            <td>755542</td>
                                            <td>Ene/01/1995</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Jorge Bermudez</td>
                                            <td>950101654897</td>
                                            <td>755542</td>
                                            <td>Ene/01/1995</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Carlos Augusto Londoño</td>
                                            <td>950101654897</td>
                                            <td>755542</td>
                                            <td>Ene/01/1995</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Hernan Pelaez</td>
                                            <td>950101654897</td>
                                            <td>755542</td>
                                            <td>Ene/01/1995</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Carlos Antonio Velez</td>
                                            <td>950101654897</td>
                                            <td>755542</td>
                                            <td>Ene/01/1995</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">

                        <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                            <div class="panel-heading">
                                <i class="fa fa-comments fa-fw"></i>
                                Chat Box
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu slidedown">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-refresh fa-fw"></i>Refresh
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-check-circle fa-fw"></i>Available
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-times fa-fw"></i>Busy
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-clock-o fa-fw"></i>Away
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-sign-out fa-fw"></i>Sign Out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <ul class="chat-box">
                                    <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        {!! Html::image('/css/assets/img/1.png',null, ['class'=>'user-image img-circle']) !!}
                                    </span>
                                        <div class="chat-body">
                                            <strong >Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                            </small>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                    <span class="chat-img pull-right">

                                        {!! Html::image('/css/assets/img/2.png',null, ['class'=>'user-image img-circle']) !!}
                                    </span>
                                        <div class="chat-body clearfix">

                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>

                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                         {!! Html::image('/css/assets/img/3.png',null, ['class'=>'user-image img-circle']) !!}
                                    </span>
                                        <div class="chat-body clearfix">

                                            <strong >Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>14 mins ago</small>

                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                         {!! Html::image('/css/assets/img/4.png',null, ['class'=>'user-image img-circle']) !!}
                                    </span>
                                        <div class="chat-body clearfix">

                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>15 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>

                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        {!! Html::image('/css/assets/img/1.png',null, ['class'=>'user-image img-circle']) !!}
                                    </span>
                                        <div class="chat-body">
                                            <strong >Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                            </small>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                       {!! Html::image('/css/assets/img/2.png',null, ['class'=>'user-image img-circle']) !!}
                                    </span>
                                        <div class="chat-body clearfix">

                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>

                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="panel-footer">
                                <div class="input-group">
                                    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message to send..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Enviar
                                    </button>
                                </span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        {{--<div class="panel panel-default">--}}
                            {{--<div class="panel-heading">
                                Label Examples
                            </div>--}}
                            {{--<div class="panel-body">
                                <span class="label label-default">Default</span>
                                <span class="label label-primary">Primary</span>
                                <span class="label label-success">Success</span>
                                <span class="label label-info">Info</span>
                                <span class="label label-warning">Warning</span>
                                <span class="label label-danger">Danger</span>
                            </div>--}}
                        {{--</div>--}}

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Grafico tipo Dona
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
@endsection

@section("scripts")


    {!! HTML::script('/css/assets/js/custom.js') !!}


@endsection
