{{--VISTA DE TABLA DE NCS POR AUDITORIA--}}
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<table class="table table-striped">
   {{-- <caption>Total registros : {{$totalregistros}} </caption>--}}
    <thead>
    <tr>
        <th>#</th>
        <th>Ciclo</th>
        <th>Usuario</th>
        <th>Actividad</th>
        <th>Descripcion</th>
        <th>Medida</th>
        <th>Plazo</th>
        <th>Estado</th>
        <th>Prioridad</th>
        <th>Reviso</th>
        <th>Tips</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ncs as $nc)
        <tr data-id="{{ $nc->id }}">
            <th scope="row">{{$nc->id}}</th>
            <td>{{$nc->auditoria->usuariosxciclo->ciclo->nombre}}</td>
            <td>{!! $nc->user->full_name !!}</td>
            <td>{!! $nc->auditoria->actividad->nombre !!}</td>
            <td><p>{!! strip_tags($nc->descripcion,'<br>') !!}</p> </td>
            <td>{!! $nc->medida !!} </td>
            <td>{!! $nc->plazo !!} </td>
            <td>{!! $nc->estadoncs->nombre !!} </td>
            <td>{!! $nc->tiponc->prioridad !!} </td>
            <td>{!! $nc->revisor->full_name !!} </td>
            <td>{!! $nc->auditoria->actividad->descripcion !!} </td>

        </tr>
   @endforeach
    </tbody>
</table>
</body>
</html>