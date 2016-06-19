@extends('app')
@section('menu')
    @include('menu.menu')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Datos usuario</div>

                    <div class="panel-body">
                        @include('admin.partials.messages')
                        @include('admin.users.partials.profile')
                        <h3 class="panel-title">Fichas asignadas</h3>
                        @include('admin.fichas.partials.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
