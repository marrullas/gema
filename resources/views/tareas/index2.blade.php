@extends('app')

@section('menu')
    @if(Session::get('tipouser')== 'user' || Session::get('tipouser')== 'instructor')

        @include('instructor.partials.menu')
    @else

        @include('admin.partials.menu')

    @endif
@endsection
@section('content')



    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">

            <div class="row" ng-app="tareasApp" ng-controller="tareasController">
                <div class="col-md-12">

                    <div class="row" >
                        <div class="col-md-9 col-sm-6 col-xs-6">
                        <div class="panel-heading bg-color-green">
                            <i class="fa fa-comments fa-fw "></i>
                            Tareas
                        </div>

                        <div class="panel-body">
                            @include('admin.partials.messages')

                            <p ng-show="mensaje.length > 0" class="alert-success"><% mensaje %></p>
                            <div class="row">



                            <div class="col-md-12 panel ">


                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label">Agregar Tarea:</label>
                                            <div class="input-group">
                                                    <input type='text' ng-model="tarea.nombre" class="form-control">
                                                                                                 <span class="input-group-btn">
                                                     <button class="btn btn-primary btn-md"  ng-click="addTarea()">Agregar</button>
                                                  </span>
                                            </div>


                                        </div>

                                        <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                              <div class="listasTareasDiv" ng-include="templateTareas.url"></div>
                              <div class="col-md-6 pull-right">
                            <table class="table table-condensed table-hover" ng-cloak>
                                <thead>
                                <tr>
                                    <th class="span1"><input type="checkbox"></th>
                                    <th class="span9">Tarea</th>
                                    <th class="span2"></th>
                                    <th class="span2"></th>
                                    <th class="span2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                                <tr ng-repeat="tarea in tareas | orderBy : 'id'  | hechoLista:selectedLista.id:0"
                                    ng-class="{'selected':$index == selectedRow}"
                                    ng-click="setClickedRow($index,tarea)">
                                    <td><input type="checkbox" ng-model ="tarea.hecho" ng-change="terminarTarea(tarea)"
                                               ng-true-value="1" ng-false-value="0">
                                    </td>
                                    <td><% tarea.nombre %>
                                        <span ng-if="tarea.prioridad === 'normal'" class="badge alert-warning"><i class="fa fa-clock-o"></i></span>
                                    </td>

                                    <td></td>
                                </tr>


                                </tbody>
                            </table>
                          </div>

                                    <div class="col-md-6 pull-right">
                            <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Tareas terminadas
                            </a>
                            <div class="collapse" id="collapseExample">
                                <div class="well">
                                    <div class="panel-group ">
                                        <table class="table table-condensed table-hover">
                                            <thead>
                                            <tr>
                                                <th class="span1"><input type="checkbox"></th>
                                                <th class="span9">Tarea</th>
                                                <th class="span2"></th>
                                                <th class="span2"></th>
                                                <th class="span2"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                                            <tr ng-repeat="terminada in tareas | orderBy : 'id'  | hechoLista:selectedLista.id:1"
                                                ng-class="{'selected':$index == selectedRow}"
                                                ng-click="setClickedRow($index,terminada)">
                                                <td><input type="checkbox" ng-model ="terminada.hecho" ng-change="terminarTarea(terminada)"
                                                           ng-true-value="1" ng-false-value="0">
                                                </td>
                                                <td><% terminada.nombre %>
                                                    <span ng-if="terminada.prioridad === 'normal'" class="badge alert-warning"><i class="fa fa-clock-o"></i></span>
                                                </td>

                                                <td></td>
                                            </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>

                            </div>
                            </div> <!-- fin row tabla 1!-->
                        </div>

                        </div>
                        {{--@include("partials.detallestarea")--}}

                        <div class="detallesDiv" ng-include src="template.url"></div>
                        <div class="modalListaDiv" ng-include="templatemodalLista.url"></div>
                        <div class="modalEditListaDiv" ng-include="templatemodalListaEdit.url"></div>


                 </div>  <!-- /. ROW  -->

                <!-- /. PAGE INNER  -->
            </div>

            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
    </div>
</div>
        @endsection


        @section("scripts")


            {!! HTML::script('/css/assets/js/custom.js') !!}
            {{--{!! HTML::script('/bower_resources/wysihtml5x/dist/wysihtml5x-toolbar.min.js') !!}--}}
                <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.0/moment-with-locales.min.js"></script>



                {!!Html::style('/bower_resources/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}
                {!! HTML::script('/bower_resources/bootstrap-select/js/bootstrap-select.js') !!}
                {!! HTML::script('/bower_resources/bootstrap-select/js/i18n/defaults-es_CL.js') !!}
                {!!Html::style('/bower_resources/bootstrap-select/css/bootstrap-select.min.css')!!}



                <script type="text/javascript">
/*                    $(function () {

                        $('#datetimepicker1').datetimepicker({
                            locale: 'es',
                            format: 'DD/MM/YYYY',
                            sideBySide:true,
                            showClear:true

                        });
                        $('#datetimepicker2').datetimepicker({
                            locale: 'es',
                            format: 'DD/MM/YYYY',
                            sideBySide:true,
                            showClear:true

                        });

                        var d = new Date();
                        d.setHours(12,00,00);

                        $('.selectpicker').selectpicker();

                    });*/
                </script>
            <!--AngularJS-->
            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>



                {!! HTML::script('/bower_resources/angular-bootstrap3-datepicker/dist/ng-bs3-datepicker.js') !!}
                {!! HTML::script('/bower_resources/angular-bootstrap/ui-bootstrap.min.js') !!}
                {!! HTML::script('/bower_resources/angular-file-upload/dist/angular-file-upload.min.js') !!}

                 <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.2.js"></script>


            {!! HTML::script('app/app.modules.js') !!}
            {!! HTML::script('app/common/commonFilters.js') !!}
            {!! HTML::script('app/tareas/tareasController.js') !!}
            {!! HTML::script('app/tareas/tareasServices.js') !!}
            {!! HTML::script('app/tareas/tareasFilters.js') !!}







@endsection