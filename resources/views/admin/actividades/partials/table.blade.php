<table class="table table-striped">
    <caption>Total registros : {{$totalactividades}} </caption>
    <thead>
    <tr>
        {{--<th>#</th>--}}
        <th>Orden</th>
        <th>Nombre</th>
        <th>Responsables</th>

    </tr>
    </thead>
    <tbody>
    @foreach($actividades as $actividad)
        <tr data-id="{{$actividad->id}}">
            {{--<th scope="row">{{$actividad->id}}</th>--}}
            <td>{!!$actividad->orden !!}</td>
            <td>{!!$actividad->nombre !!}</td>
            <td>{!!$actividad->responsable !!}</td>
            <td>
                <div class="panel-group">
                    <div class="dropdown pull-right">
                        <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.actividades.edit', $actividad) }}"><i class="glyphicon glyphicon-edit"> Editar</i></a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.actividades.show', $actividad) }}"><i class="fa fa-info"> Detalles</i></a></li>
                            <li role="presentation"><a href="{{ URL::route('files.create','prefijo=AC&codigo='.$actividad->id) }}" class="btn btn-success btn-sm">Agregar archivo</a></li>
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
