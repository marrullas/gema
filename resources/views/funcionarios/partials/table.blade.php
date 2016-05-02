<table class="table table-striped">
    <caption>Total registros : {{($funcionariosie->count()>=0)?$funcionariosie->count():$funcionariosie->total()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>IE</th>
        <th>Cargo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($funcionariosie as $funcionario)
        <tr data-id="{{$funcionario->id}}">
            <th scope="row">{{$funcionario->id}}</th>
            <td>{{$funcionario->nombre}}</td>
            <td>{{$funcionario->telefono}}</td>
            <td>{{$funcionario->correo}}</td>
            <td>{{$funcionario->ie->nombre}}</td>
            <td>{{$funcionario->tipofuncionario->nombre}}</td>
            <td>
                <a class="btn btn-info btn-xs" href="{{ route('funcionarios.edit', $funcionario) }}">Editar</a>
                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>