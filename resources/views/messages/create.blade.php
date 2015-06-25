@extends('app')
@section('menu')
    @include('instructor.partials.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Nuevo mensaje</div>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        {!! Form::open(['route'=> 'message.store', 'method' => 'POST' ]) !!}
                        @include('messages.partials.fields')

                        <button type="submit" class="btn btn-default">Enviar mensaje
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    {!! HTML::script('/css/assets/js/custom.js') !!}
@endsection