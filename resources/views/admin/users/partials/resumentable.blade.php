<table class="table table-striped">
    @if(!$reporte)
        <caption>Total registros : {{$users->total()}} </caption>
    @else
        <caption>Total registros : {{$users->count()}} </caption>
    @endif

    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>horas</th>
        <th>eventos</th>
        <th>dias</th>

    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr data-id="{{$user->id}}">
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->full_name}}</td>
            <td>{{$user->horas}}</td>
            <td>{{$user->nueventos}}</td>
            <td>{{$user->dias}}</td>

            <td>
                @if(!$reporte)
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/calendar/'.$user->id) }}">Calendario</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/agenda/'.$user->id) }}">Agenda</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  \Illuminate\Support\Facades\URL::to('/eventos/actividades?userId='.$user->id) }}">Actividades</a></li>
                        </ul>
                    </div>
                    <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>