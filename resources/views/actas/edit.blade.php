@extends('app')

@section('menu')
    @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

        @include('instructor.partials.menu')
    @else

        @include('admin.partials.menu')

    @endif
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Editar ACTA</div></h3>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::model($acta,['route'=> ['actas.update', $acta], 'method' => 'PUT' ]) !!}
                        @include('actas.partials.fields')
                        <button type="submit" class="btn btn-primary">Actualizar ACTA
                        </button>
                        {!! Form::close() !!}
                        {{--@include('actas.partials.delete')--}}


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection
