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
                    <h3 class="panel-title">DATOS DEL CICLO</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://www.faisanesdelmundo.com/img/read.jpg" class="img-circle img-responsive"> </div>


                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Ciclo:</td>
                                    <td>{{$ciclo->nombre}}</td>
                                </tr>
                                <tr>
                                    <td>Descripción:</td>
                                    <td>{!! $ciclo->descripcion !!}</td>
                                </tr>
                                <tr>
                                    <td>Ambito:</td>
                                    <td>{{$ciclo->ambito->nombre}}</td>
                                </tr>
                                <tr>
                                    <td>Procedimiento:</td>
                                    <td>{{$ciclo->procedimiento->nombre}}</td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>Fecha inicio:</td>
                                    <td>{!!$ciclo->fecha_ini!!}</td>
                                </tr>
                                <tr>
                                    <td>Fecha Final:</td>
                                    <td>{!!$ciclo->fecha_fin!!}</td>
                                </tr>
                                <tr>
                                    <td>Estado:</td>
                                    @if($ciclo->activo == 1)
                                        <td>Activo</td>
                                    @else
                                        <td>Inactivo</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Publico:</td>
                                    @if($ciclo->publico == 1)
                                        <td>SI</td>
                                    @else
                                        <td>NO</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="{{ URL::route('admin.ciclos.index') }}" class="btn btn-primary btn-sm">Volver </a>
                        {{--<a href="{{ URL::route('admin.actividades.create','procedimiento='.$ciclo->id) }}" class="btn btn-success btn-sm">Agregar actividad</a>--}}
                        <span class="pull-right">
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.ciclos.edit', $ciclo) }}"><i class="glyphicon glyphicon-edit"></i></a>

                        </span>
                    <span class="pull-right">
                    @include('admin.ciclos.partials.delete')
                    </span>

                </div>

            </div>
        </div>
    </div> <!--row!-->
{{-- se deja por si sirve para mostar los elementos que deben estar en el ciclo
    <div class="row">
        <div class="col-md-10 col-md-offset-1 toppad" >
            @include('admin.actividades.partials.table')
        </div>
    </div><!--row!-->--}}
</div>
@endsection
@section('scripts')
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection
