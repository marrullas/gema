@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 toppad" >


                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">DATOS DE LA ACTIVIDAD A AUDITAR: [Ciclo: <b>{{$auditoria->usuariosxciclo->ciclo->nombre}}</b>] [Usuario: <b>{{$auditoria->usuariosxciclo->user->full_name}}</b>]</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://www.faisanesdelmundo.com/img/read.jpg" class="img-circle img-responsive"> </div>


                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Actividad:</td>
                                        <td>{{$auditoria->actividad->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nc's resueltas:</td>
                                        <td>{{$auditoria->ncsResueltasCount}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nc's pendientes:</td>
                                        <td>{{$auditoria->ncsPendientesCount}}</td>
                                    </tr>
                                    <tr>
                                        <td>Certificado:</td>
                                        <td>{!! ($auditoria->certificado ? 'SI':'NO')  !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Detalles certificacioón:</td>
                                        <td>{!! $auditoria->detalles  !!}</td>
                                    </tr>

                                    <tr>
                                    </tbody>
                                </table>
                                <a class="btn btn-primary btn-xs" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Mas...
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                            <div class="btn-group pull-right">
                            <a href="{{ url('admin/auditoria',$auditoria->usuariosxciclo_id) }}" class="btn btn-primary btn-sm">Volver </a>
                                </div>
                            @if($auditoria->ncsPendientesCount == 0)
                                @include('admin.ciclos.auditoria.partials.certificaractividad')
                            @endif
                            @if(Auth::user()->type == 'auditor' || Auth::user()->type == 'admin')
                            @include('admin.ciclos.auditoria.partials.crearnc')
                            @endif
                        @if(!$auditoria->certificado)
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal2">Crear NC</button>
                        @endif
                    </div>


                </div>
            </div>
        </div> <!--row!-->
        <div class="row"> {{--contenido--}}
            <div class="col-md-10 col-md-offset-1 toppad" >
                {{--@include('admin.ciclos.auditoria.partials.actividades')--}}
                @include('admin.ciclos.auditoria.partials.gridncs')
            </div>
        </div><!--row!-->
    </div>
@endsection
@section('scripts')
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection
