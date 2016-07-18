    <div class="row">
        @foreach($ncs as $nc)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="box">
                <div class="box-icon">
                    @if($nc->estadoncs_id == 3)
                        <span class="fa fa-4x fa-thumbs-up"><h4>Cerrada</h4></span>
                    @elseif($nc->estadoncs_id == 2)
                        <span class="fa fa-4x fa-clock-o"><h4>Devuelta</h4></span>
                    @else
                        <span class="fa fa-4x fa-thumbs-down"> <h4>Abierta</h4></span>
                    @endif
                </div>
                <div class="info">
                    <b> CICLO: </b> <em>{{$nc->auditoria->usuariosxciclo->ciclo->nombre}}</em>
                    <b> PLAZO: </b> <em>{{$nc->plazo}}</em>
                    <h4 class="text-center">{!! $nc->auditoria->actividad->nombre !!}</h4>
                    <div class="error-notice">
                        <div class="oaerror danger">
                            <strong>Descripcion</strong> - {!! $nc->descripcion !!}
                        </div>
                        <div class="oaerror warning">
                            <strong>Medida</strong> - {!! $nc->medida !!}
                        </div>
                        @foreach($nc->seguimientos as $seguimiento)
                        <div class="oaerror info">
                            <strong>Seguimiento</strong> - {!! $seguimiento->detalle !!}
                        </div>
                        @endforeach
                    </div>
                   {{-- <p>{!! $nc->descripcion !!}</p>--}}
                    <p><b> ÚLTIMA MODIFICACIÓN: </b> <em>{{$nc->updated_at}}</em></p>
                    {{--<a href="" class="btn btn-success btn-sm">Devolver</a>--}}
                    @if($nc->user_id == Auth::user()->id && ($nc->estadoncs_id == 1)){{--solo se puede devolver una nc de la que se es responsable--}}
                    <button href="#" class="btn btn-inverse" data-toggle="modal" data-target="#myModaldevolvernc{{$nc->id}}"><i class="glyphicon glyphicon-backward"></i> <strong>Devolver</strong></button>
                    @endif
                    <a href="{{url('auditoria/showactividad/'.$nc->auditoria->actividad->id)}}" class="btn btn-info btn-sm">Info. Actividad</a>
                </div>
            </div>
        </div>
            @include('admin.ciclos.auditoria.partials.devolvernc');
        @endforeach

    </div>
