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
        <div class="col-md-10 col-md-offset-1 toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">DATOS DE LA ACTIVIDAD</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://www.faisanesdelmundo.com/img/read.jpg" class="img-circle img-responsive"> </div>

                        <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                          <dl>
                            <dt>DEPARTMENT:</dt>
                            <dd>Administrator</dd>
                            <dt>HIRE DATE</dt>
                            <dd>11/12/2013</dd>
                            <dt>DATE OF BIRTH</dt>
                               <dd>11/12/2013</dd>
                            <dt>GENDER</dt>
                            <dd>Male</dd>
                          </dl>
                        </div>-->
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
                                <tr>
                                    <td>Orden:</td>
                                    <td>{!!$actividad->orden!!}</td>
                                </tr>
                                <tr>
                                    <td>Actividad siguiente:</td>
                                    <td>{!!$actividad->actividad_siguiente!!}</td>
                                </tr>




                                </tbody>
                            </table>
                        </div>


                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="{{ URL::to('admin/procedimientos',$actividad->procedimiento) }}" class="btn btn-primary btn-sm">Volver</a>
                    <a href="{{ URL::route('files.create','prefijo=AC&codigo='.$actividad->id) }}" class="btn btn-success btn-sm">Agregar archivo</a>
                        <span class="pull-right">
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.actividades.edit', $actividad) }}"><i class="glyphicon glyphicon-edit"></i></a>
                        </span>
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
