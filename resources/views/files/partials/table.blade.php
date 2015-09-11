<table class="table table-striped">
    <caption>Total registros : {{$files->count()}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Archivo</th>
        <th>Descripción</th>
        <th>Tipo</th>
        <th>Enviado por</th>
        <th>Fecha envio</th>


    </tr>
    </thead>
    <tbody>
    @foreach($files as $file)
        <tr data-id="{{$file->id}}">
            <th scope="row">{{$file->id}}</th>
            <td>
                <a href="{{ url('download?file='.$file->id) }}" download="{!!$file->filename !!}">
                    {{ $file->filename }}
                </a>


            </td>
            <td>{!!$file->descripcion !!}</td>
            <td>{!!$file->tipodocumento->nombre !!}</td>
            <td>{!!$file->user->full_name !!}</td>
            <td>{!!$file->created_at !!}</td>

            <td>
                <div class="panel-group">

                    <div class="dropdown pull-right">
                        <button class="btn btn-default dropdown-toggle btn-xs btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            {!! Form::open(['route'=> ['files.destroy',$file], 'method' => 'DELETE' ]) !!}
                            {!! Form::hidden('desde','actividad') !!}
                            {!! Form::hidden('actividad',$file->codigo) !!}
                            <li role="presentation"><button class="btn-link" type="submit" onclick="return confirm('Esta seguro que quiere eliminar este registro?')" role="button" tabindex="-1"><i class="glyphicon glyphicon-edit"> Eliminar</i></button></li>
                            {!! Form::close() !!}
                            {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.actividades.show', $actividad) }}"><i class="fa fa-info"> Detalles</i></a></li>--}}
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