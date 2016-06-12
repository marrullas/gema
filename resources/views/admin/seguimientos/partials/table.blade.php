<table class="table table-condensed table-striped">
    <caption>Total registros : {{$seguimientos->count()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Usuario</th>

        <th>estado</th>
        <th>Descripcion</th>
        <th>Creado</th>
        <th>Fecha entrega</th>
        <th>Visibilidad</th>
    </tr>
    </thead>
    <tbody>
    @foreach($seguimientos as $seguimiento)
{{--        <tr data-id="{{$seguimiento->id}}">
            <th scope="row">{{$seguimiento->id}}</th>
            <td><h4>{{$seguimiento->descripcion}}</h4>
            {!!$seguimiento->detalles!!}</td>
            <td>{!! $seguimiento->estadoseguimiento->nombre !!}</td>
            <td>{{$seguimiento->fecha_entrega}}</td>
            <td>{{$seguimiento->usuarioseguimiento->full_name}}</td>
            <td>{{$seguimiento->visible}}</td>
            <td>
                <a class="btn btn-info btn-xs" href="{{ route('admin.seguimientos.edit', $seguimiento) }}">Editar</a>
                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>--}}
<tr>
    <td><a href="{{ route('admin.seguimientos.edit', $seguimiento) }}">
            <i class="-alt fa fa-2x {{$seguimiento->estadoseguimiento->icono}} fa-fw"></i></a></td>
    <td><strong>{{$seguimiento->usuarioseguimiento->full_name}}</strong></td>
    <td><span class="label pull-left" style="background-color: {{$seguimiento->estadoseguimiento->color}};">{!! $seguimiento->estadoseguimiento->nombre !!}</span></td>
    <td><strong>{{$seguimiento->descripcion}}</strong></td>
    <td><strong>{{$seguimiento->created_at}}</strong></td>
    <td><strong>{{$seguimiento->fecha_entrega}}</strong></td>
    <td><strong>{{($seguimiento->fecha_entrega)?'compartido':'privado'}}</strong></td>
</tr>
    @endforeach
    </tbody>
</table>