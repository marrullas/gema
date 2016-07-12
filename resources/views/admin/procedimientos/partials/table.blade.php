<table class="table table-striped">
    <caption>Total registros : {{$procedimientos->total()}} </caption>
    <thead>
    <tr>
        {{--<th>#</th>--}}
        <th>Procedimiento</th>
        <th>Version</th>
        <th>Codigo</th>
        <th>Vigencia</th>

    </tr>
    </thead>
    <tbody>
    @foreach($procedimientos as $procedimiento)
        <tr data-id="{{$procedimiento->id}}">
            {{--<th scope="row">{{$procedimiento->id}}</th>--}}
            <td>{!!$procedimiento->nombre !!}</td>
            <td>{!!$procedimiento->version !!}</td>
            <td>{!!$procedimiento->codigo !!}</td>
            <td>{!!$procedimiento->vigencia !!}</td>

            <td>
                <div class="panel-group">
                    <div class="dropdown pull-right">
                        <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.procedimientos.edit', $procedimiento) }}"><i class="fa fa-edit"> Editar</i></a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-2" href="{{ route('admin.procedimientos.show', $procedimiento) }}"><i class="fa fa-info"> Detalles</i></a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-2" href="{{ url('admin/procedimientos/duplicar', $procedimiento) }}"><i class="fa fa-copy"> Duplicar</i></a></li>
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