<table class="table table-striped">
    <caption>Total registros : {{$actas->total()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Codigo</th>
        <th>Fecha</th>
        <th>Archivo</th>
        <th>Ficha</th>
        <th>Usuario</th>
    </tr>
    </thead>
    <tbody>
    @foreach($actas as $acta)
        <tr data-id="{{$acta->id}}">
            <th scope="row">{{$acta->id}}</th>
            <th scope="row">{{$acta->prefijo}}{{$acta->id}}</th>
            <td>{{$acta->created_at}}</td>
            <td><a href="{{ url('download?path='.$acta->archivo) }}">
                    {{ $acta->archivo_nombre }}
                </a></td>
            @if(!empty($acta->evento))
                <td>{{$acta->evento->ficha_id}}</td>
            @else
                <td></td>
            @endif
            <td>{{$acta->user->full_name}}</td>
            <td>
                <a class="btn btn-info btn-xs" href="{{ route('actas.edit', $acta) }}">Editar</a>
                <a class="btn btn-sm btn-success btn-xs" href="{{ route('actas.show', $acta) }}"><i class="fa fa-info"></i></a>
                <!--<a href="#!" class="btn btn-danger btn-xs">Eliminar</a> -->

            </td>
        </tr>
    @endforeach
    </tbody>
</table>