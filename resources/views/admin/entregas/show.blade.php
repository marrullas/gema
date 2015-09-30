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
                    <h3 class="panel-title">DATOS DE LA ENTREGA</h3>
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
                                    <td>{!! $entrega->actividad->procedimiento->nombre !!}</td>
                                </tr>
                                <tr>
                                    <td>Actividad:</td>
                                    <td>{!! $entrega->actividad->nombre  !!}</td>
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
                                    <td>{!! $entrega->descripcion  !!}</td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>numero de archivos:</td>
                                    <td>{!!$entrega->numeroarchivos!!}</td>
                                </tr>
                                <tr>
                                    <td>Documento:</td>
                                    @if(!empty($entrega->documento->nombre))
                                        <td>{!!$entrega->documento->nombre!!}</td>
                                    @endif
                                </tr>

                                </tbody>
                            </table>
                        </div>


                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="{{ URL::to('admin/ciclos') }}" class="btn btn-success btn-sm">Ciclos</a>
                    <a href="{{ URL::to('admin/ciclos',$entrega->ciclo_id) }}" class="btn btn-primary btn-sm"> << Volver</a>
                        <span class="pull-right">
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.entregas.edit', $entrega) }}"><i class="glyphicon glyphicon-edit"></i></a>
                        </span>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection
