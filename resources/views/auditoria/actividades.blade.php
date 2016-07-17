{{--URL: /auditoria/veractividades/{id}--}}
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
                        <h3 class="panel-title">ACTIVIDADES QUE SE AUDITAN PARA: {{Auth::user()->full_name}} </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://www.faisanesdelmundo.com/img/read.jpg" class="img-circle img-responsive"> </div>


                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Usuario:</td>
                                        <td>{{$usuariosxciclo->user->full_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ciclo:</td>
                                        <td>{{$usuariosxciclo->ciclo->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Procedimiento:</td>
                                        <td>{{$usuariosxciclo->ciclo->procedimiento->nombre}}</td>
                                    </tr>

                                    <tr>
                                    </tbody>
                                </table>
                               {{-- <a class="btn btn-primary btn-xs" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Mas...
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Vigencia:</td>
                                            <td>{!!$procedimiento->vigencia!!}</td>
                                        </tr>
                                        <tr>
                                            <td>Objetivo:</td>
                                            <td>{!!$procedimiento->objetivo!!}</td>
                                        </tr>
                                        <tr>
                                            <td>Responsable:</td>
                                            <td>{!!$procedimiento->responsable!!}</td>
                                        </tr>
                                        <tr>
                                            <td>Alcance:</td>
                                            <td>{!!$procedimiento->alcance!!}</td>
                                        </tr>
                                        <tr>
                                            <td>Generalidades:</td>
                                            <td>{!!$procedimiento->generalidades!!}</td>
                                        </tr>
                                        <tr>
                                            <td>Archivo:</td>
                                            <td>
                                                <a href="{{ url('download?path='.$procedimiento->archivo) }}">
                                                    {{ $procedimiento->archivo }}
                                                </a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Creador:</td>
                                            <td>{{$procedimiento->user->full_name}}</td>
                                        </tr>
                                                                        <td>Phone Number</td>
                                                                        <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
                                                                        </td>

                                                                        </tr>

                                        </tbody>
                                    </table>
                                </div>--}}


                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{url('auditoria')}}" class="btn btn-primary btn-sm">Volver </a>

{{--
                            <a href="{{ URL::route('admin.actividades.create','procedimiento='.$procedimiento->id) }}" class="btn btn-success btn-sm">Agregar actividad</a>
                        <span class="pull-right">
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.procedimientos.edit', $procedimiento) }}"><i class="glyphicon glyphicon-edit"></i></a>
                        </span>
--}}

                    </div>

                </div>
            </div>
        </div> <!--row!-->
        <div class="row">
            <div class="col-md-10 col-md-offset-1 toppad" >
                @include('auditoria.partials.tableactividadesauditar')
            </div>
        </div><!--row!-->
    </div>
@endsection
@section('scripts')
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection
