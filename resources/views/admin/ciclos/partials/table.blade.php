<table class="table table-striped">
    <caption>Total registros : {{$ciclos->total()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Ciclo</th>
        <th>Descripción</th>
        <th>Ambito</th>
        <th>Fecha inicio</th>
        <th>Fecha final</th>

    </tr>
    </thead>
    <tbody>
    @foreach($ciclos as $ciclo)
        <tr data-id="{{$ciclo->id}}">
            <th scope="row">{{$ciclo->id}}</th>
            <td>{!!$ciclo->nombre !!}</td>
            <td>{!!$ciclo->descripcion !!}</td>
            <td>{!!$ciclo->ambito->nombre !!}</td>
            <td>{!!$ciclo->fecha_ini !!}</td>
            <td>{!!$ciclo->fecha_fin !!}</td>

            <td>
                <div class="panel-group">
                    <div class="dropdown pull-right">
                        <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.ciclos.edit', $ciclo) }}"><i class="fa fa-edit"> Editar</i></a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-2" href="{{ route('admin.ciclos.show', $ciclo) }}"><i class="fa fa-info"> Detalles</i></a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/admin/ciclos/activar/'.$ciclo->id) }}">Activar ciclo</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/admin/entregas/ciclo/'.$ciclo->id) }}">Entregas por ciclo</a></li>

                        </ul>
                    </div>
                </div>



                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>