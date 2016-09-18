<table class="table table-striped">
    <caption>Tipos de actividades :   <b class="badge">{{$actividadestotal->count()}}</b></caption>
    <thead>
    <tr>

        <th>Actividad</th>
        {{--<th>Horas </th>--}}

    </tr>
    </thead>
    <tbody>

    @foreach($actividadestotal as $actividad)

            <tr data-id="{{$actividad->id}}">
            <td>{{$actividad->actividad}}</td>
            {{--<td>{{$actividad->horas   }}</td>--}}

        </tr>
    @endforeach

{{--    <tr>
    <td><b>Total de horas periodo</b></td>
        <td><b>{{$totalhorasmes}}</b></td>

    </tr>--}}
    </tbody>
</table>