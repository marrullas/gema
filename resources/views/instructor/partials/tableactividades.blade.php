<table class="table table-striped">
    <caption>Actividades :   <b class="badge">{{$actividades->count()}}</b></caption>
    <thead>
    <tr>

        <th>Ficha/I.E.</th>
        <th>Programa</th>
        <th>Grado</th>
        <th>Ficha</th>
        <th>Actividad</th>
        <th>Ciudad</th>
        {{--<th>Horas </th>--}}
    </tr>
    </thead>
    <tbody>

    @foreach($actividades as $actividad)

            <tr data-id="{{$actividad->id}}">
            <td>{{$actividad->ficha->full_name}}</td>
            <td>{{$actividad->ficha->programa->nombre}}</td>
            <td>{{$actividad->ficha->grado}}</td>
            <td>{{$actividad->ficha->codigo}}</td>
            <td>{{$actividad->actividad}}</td>
            <td>{{$actividad->ficha->ie->ciudad->nombre    }}</td>
                {{--<td>{{$actividad->horas   }}</td>--}}
        </tr>
    @endforeach

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

{{--    <td><b>Total de horas periodo</b></td>
        <td><b>{{$totalhorasmes}}</b></td>--}}

    </tr>
    </tbody>
</table>