{{--<div class="panel panel-info">
    <div class="panel-heading"><h3>Agregar Halazgo</h3></div>
        <div class="panel-group ">
        {!! Form::open(['route'  => 'calendar.store', 'method' => 'POST','class'=>'form']) !!}
        {!! Form::hidden('user_id',\Illuminate\Support\Facades\Auth::user()->id) !!}
        @include('admin.ciclos.auditoria.partials.fields')
        <!-- falta la marca para todo el dia y el boton de guardar -->
            <button type="submit" class="btn btn-primary">Registrar</button>
            {!!Form::close()!!}
        </div>
</div>--}}

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Hallazgo</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['route'  => 'ncs.store', 'method' => 'POST','class'=>'form']) !!}
            @include('admin.ciclos.auditoria.partials.fields')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear NC</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div> <!-- Fin moda -->