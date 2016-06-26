
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
{{--                        <div class="oaerror success">
                            <strong>Yeppi</strong> - You are successfully registered. Please login.
                        </div>--}}
                    </div>
                   {{-- <p>{!! $nc->descripcion !!}</p>--}}
                    <p><b> ÚLTIMA MODIFICACIÓN: </b> <em>{{$nc->updated_at}}</em></p>
                    <a href="" class="btn btn-success btn-sm">Devolver</a>
                    <a href="{{url('auditoria/showactividad/'.$nc->auditoria->actividad->id)}}" class="btn btn-info btn-sm">Info. Actividad</a>
                </div>
            </div>
        </div>
        @endforeach

{{--        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="box">
                <div class="box-icon">
                    <span class="fa fa-4x fa-css3"></span>
                </div>
                <div class="info">
                    <h4 class="text-center">Title</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                    <a href="" class="btn">Link</a>
                </div>
            </div>
        </div>--}}
    </div>
