<table class="table table-striped">
    <caption>Eventos reportados :   <b class="badge">{{$fichasasignadas->count()}}</b></caption>
    <thead>
    <tr>

        <th>Nombre</th>
        <th>Programa</th>
        <th>Grado</th>
        <th>Ciudad</th>
        <th>Inicio</th>
        <th>Fin</th>
        {{--<th>Horas </th>--}}
        <th>Fecha evento</th>
    </tr>
    </thead>
    <tbody>

    @foreach($fichasasignadas as $ficha)

            <tr data-id="{{$ficha->id}}">
            <td>{{$ficha->ficha->full_name}}</td>
            <td>{{$ficha->ficha->programa->nombre}}</td>
            <td>{{$ficha->ficha->grado}}</td>
            <td>{{$ficha->ficha->ie->ciudad->nombre    }}</td>
            <td>{{ \Carbon\Carbon::parse($ficha->start)->format('h:i')   }}</td>
            <td>{{ \Carbon\Carbon::parse($ficha->end)->format('h:i')   }}</td>
                {{--<td>{{$ficha->ficha->horas_acumuladas->first()['horas']   }}</td>--}}
                {{--<td>{{$ficha->horas   }}</td>--}}
                <td>{{ \Carbon\Carbon::parse($ficha->start)->format('Y/m/d')   }}</td>

            <td>
                @if(!$reporte)
                    <a class="btn btn-info btn-xs" href="{{ url('eventos/edit', $ficha) }}">Editar</a>
                @endif
                <!--
                <a class="btn btn-warning btn-xs" href="{{  \Illuminate\Support\Facades\URL::to('/calendar/'.$ficha->id) }}">Programación</a>
                <a class="btn btn-info btn-xs" href="{{ route('admin.users.edit', $ficha) }}">Editar</a>
               <a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach

    <tr>


{{--
    <td><b>Total de horas mes</b></td>
        <td><b>{{$totalhorasmes}}</b></td>
--}}

    </tr>
    </tbody>
</table>