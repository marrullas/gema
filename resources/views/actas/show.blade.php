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
                    <h3 class="panel-title">DATOS DEL ACTA</h3>
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
                                    <td>Numero de acta:</td>
                                    <td>{{$acta->prefijo}}{{$acta->id}}</td>
                                </tr>
                                <tr>
                                    <td>Fecha solicitud:</td>
                                    <td>{{$acta->created_at}}</td>
                                </tr>
                                <tr>
                                    <td>Usuario:</td>
                                    <td>{{$acta->user->full_name}}</td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>Detalle:</td>
                                    <td>{!!$acta->justificacion!!}</td>
                                </tr>
                                <tr>
                                    <td>Archivo:</td>
                                    <td>
                                    <a href="{{ url('download?path='.$acta->archivo) }}">
                                        {{ $acta->archivo_nombre }}
                                    </a>
                                    </td>

                                </tr>
{{--                                <td>Phone Number</td>
                                <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
                                </td>

                                </tr>--}}

                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="{{ URL::route('actas.index') }}" class="btn btn-primary btn-sm">Volver</a>
                        <span class="pull-right">
                            <a class="btn btn-sm btn-warning" href="{{ route('actas.edit', $acta) }}"><i class="glyphicon glyphicon-edit"></i></a>
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
