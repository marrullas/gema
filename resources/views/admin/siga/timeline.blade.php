@extends('app')
@section('menu')
    @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

        @include('instructor.partials.menu')
    @else

        @include('admin.partials.menu')

    @endif
@section('content')
    <div id="page-wrapper">
        <div class="row container">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Timeline
                        <a class="btn btn-info" href="{{ \Illuminate\Support\Facades\URL::to('/siga/resumen/') }}" role="button"> << Volver</a>
                    </div>
                    @if(Session::has('message'))
                        <p class="alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <div>
                        <div class="page-header">
                            <h1 id="">Timeline: {{ $entregas->first()->ciclo_nombre }} - {{ $entregas->first()->user_nombre }}</h1>
                        </div>
                        <div id="timeline"><div class="row timeline-movement timeline-movement-top">
                                <div class="timeline-badge timeline-future-movement">
                                    <a href="#">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                </div>
                                <div class="timeline-badge timeline-filter-movement">
                                    <a href="#">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </a>
                                </div>

                            </div>
                            <div class="row timeline-movement">

{{--                                <div class="timeline-badge">
                                    <span class="timeline-balloon-date-day">18</span>
                                    <span class="timeline-balloon-date-month">APR</span>
                                </div>--}}


                                <div class="col-sm-6  timeline-item">
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="timeline-panel credits">
                                                <ul class="timeline-panel-ul">
                                                    <li><span class="importo">ACTIVIDADES REALIZADAS</span></li>
{{--                                                    <li><span class="causale">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span> </li>
                                                    <li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11/09/2014</small></p> </li>--}}
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6  timeline-item">
                                    <div class="row">
                                        <div class="col-sm-offset-1 col-sm-11">
                                            <div class="timeline-panel debits">
                                                <ul class="timeline-panel-ul">
                                                    <li><span class="importo">ACTIVIDADES PENDIENTES</span></li>
{{--                                                    <li><span class="causale">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span> </li>
                                                    <li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11/09/2014</small></p> </li>--}}
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--due -->

                            <div class="row timeline-movement">

                                @foreach($entregas as $entrega)
{{--                                <div class="timeline-badge">
                                    <span class="timeline-balloon-date-day">13</span>
                                    <span class="timeline-balloon-date-month">APR</span>
                                </div>--}}
                                @if($entrega->numeroarchivos > $entrega->filecount)
                                <div class="col-sm-offset-6 col-sm-6  timeline-item">
                                    <div class="row">
                                        <div class="col-sm-offset-1 col-sm-11">
                                            <div class="timeline-panel debits">
                                                <ul class="timeline-panel-ul">
                                                    <li><span class="importo">{{$entrega->actividad_nombre}}</span></li>
                                                    {{--<li><span class="causale">{!! $entrega->actividad_descripcion !!} </span> </li>--}}
                                                    @if($entrega->fecha)
                                                        <li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Fecha entrega: {{$entrega->fecha}}</small></p> </li>
                                                    @endif

                                                </ul>
                                                @if($files->count() > 0)
                                                    @foreach($files as $file)
                                                        @if($file->codigo == $entrega->entregas_id)
                                                    <ul>
                                                        <a href="{{ url('download?file='.$file->id) }}" download="{!!$file->filename !!}">
                                                            {{ $file->filename }}
                                                        </a>
                                                    </ul>
                                                        @endif
                                                    @endforeach

                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-6  timeline-item">
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="timeline-panel credits">
                                                <ul class="timeline-panel-ul">
                                                    <li><span class="importo">{{$entrega->actividad_nombre}}</span></li>
                                                    {{--<li><span class="causale">{!! $entrega->actividad_descripcion !!} </span> </li>--}}
                                                    @if($entrega->fecha)
                                                        <li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Fecha entrega: {{$entrega->fecha}}</small></p> </li>
                                                    @endif

                                                @if($files->count() > 0)
                                                        <li><span class="importo">Evidencia</span></li>
                                                    @foreach($files as $file)
                                                        @if($file->codigo == $entrega->entregas_id)

                                                            <li>
                                                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Entregado el: {{$file->created_at}}</small></p>
                                                                <a href="{{ url('download?file='.$file->id) }}" download="{!!$file->filename !!}">
                                                                    {{ $file->filename }}
                                                                </a>

                                                            </li>

                                                        @endif
                                                    @endforeach

                                                @endif
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                    @endif
                                @endforeach

                            </div>

                        </div>
                    </div> {{--fin timeline--}}
                </div>
            </div>
        </div>
    </div>
{{--    {!! Form::open(['route'=> ['admin.users.destroy',':USER_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
    {!! Form::close() !!}--}}

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {


            $('.btn-delete').click(function(e){

                e.preventDefault();

                var row = $(this).parents('tr');
                var id = row.data('id');
                var form =  $('#form-delete');
                var url = form.attr('action').replace(':USER_ID',id);
                var data = form.serialize();
                row.fadeOut();
                $.post(url,data, function(result) {

                    alert(result.message);

                }).fail(function(){
                    alert('El usuario no pudo ser eliminado');
                    row.show();
                });


            });

        });
    </script>
@endsection