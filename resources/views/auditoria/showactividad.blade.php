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
                    <h3 class="panel-title">DATOS DE LA ACTIVIDAD</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://www.faisanesdelmundo.com/img/read.jpg" class="img-circle img-responsive"> </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Procedimiento:</td>
                                    <td>{!! $actividad->procedimiento->nombre !!}</td>
                                </tr>
                                <tr>
                                    <td>Nombre:</td>
                                    <td>{!! $actividad->nombre  !!}</td>
                                </tr>
                                </tbody>
                            </table>
                            <a class="btn btn-primary btn-xs" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Mas...
                            </a>
                            <div class="collapse" id="collapseExample">
                                    <table class="table table-user-information">
                                        <tbody>
                                <tr>
                                    <td>Descripción:</td>
                                    <td>{!! $actividad->descripcion  !!}</td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>Resposable:</td>
                                    <td>{!!$actividad->responsable!!}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="{{ URL::to('auditoria/mostrarncs') }}" class="btn btn-primary btn-sm">Volver</a>
                </div>

            </div>
        </div>
    </div>
    <div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Archivos relacionados</h3>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 toppad" >
            @if(Session::has('message'))
                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>{{ Session::get('message') }}</strong>
                </div>

            @endif
            @include('files.partials.table')
        </div>
    </div><!--row!-->
        </div>
</div>
@endsection
@section('scripts')
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection
