<table class="table table-striped">
    <caption>Total registros : {{$totalentregas}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Actividad</th>
        <th>Ciclo</th>
        <th>Documento</th>
        <th>Numero evidencias</th>
        <th>Fecha</th>


    </tr>
    </thead>
    <tbody>
    @foreach($entregas as $entrega)
        <tr data-id="{{$entrega->id}}">
            <th scope="row">{{$entrega->id}}</th>
            <td>{!!$entrega->actividad->nombre !!}</td>
            <td>{!!$entrega->numeroarchivos !!}</td>
            <td>{!!$entrega->ciclo->nombre !!}</td>
            @if(!empty($entrega->documento))
            <td>{!!$entrega->documento->nombre !!}</td>
            @else
                <td>N/A</td>
            @endif

            <td>{!!$entrega->fecha !!}</td>

            <td>
                <div class="panel-group">
                    <div class="dropdown pull-right">
                        <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.entregas.edit', $entrega) }}"><i class="glyphicon glyphicon-edit"> Editar</i></a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.entregas.show', $entrega) }}"><i class="fa fa-info"> Detalles</i></a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/admin/entregas/create/'.$ciclo.'/'.$entrega->actividad_id) }}"><i class="fa fa-info"> Agrega Entrega</i></a></li>

                            {{--<li role="presentation"><a href="{{ URL::route('files.create','prefijo=AC&codigo='.$entrega->id) }}" class="btn btn-success btn-sm">Agregar archivo</a></li>--}}
                            {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/actividades?userId=') }}">Documentos</a></li>--}}
                        </ul>
                    </div>
                </div>



                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
