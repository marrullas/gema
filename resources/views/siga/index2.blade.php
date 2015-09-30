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

            <div class="row" ng-app="sigaApp" ng-controller="sigaController">
                <div class="col-md-12">

                    <div class="row" >
                        <div class="col-md-9 col-sm-6 col-xs-6">
                        <div class="panel-heading bg-color-green">
                            <i class="fa fa-comments fa-fw "></i>
                            SIGA
                        </div>

                        <div class="panel-body">
                            @include('admin.partials.messages')

                            <p ng-show="mensaje.length > 0" class="alert-success" ng-cloak><% mensaje %></p>
                            <div class="row">
                            </div>
                            <div class="row">
                              <div class="listasTareasDiv" ng-include="templateTareas.url"></div>
                              <div class="col-md-6 pull-right">
                            <table class="table table-condensed table-hover" ng-cloak>
                                <thead>
                                <tr>
                                    <th class="span1"><b>Actividades</b></th>
                                    <th class="span9"><% tarea.ciclo.procedimiento.nombre %></th>
                                    <th class="span2"></th>
                                    <th class="span2"></th>
                                    <th class="span2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                                <tr ng-repeat="tarea in tareas | orderBy : ['actividad_id','id']"
                                    ng-class="{'selected':$index == selectedRow}"
                                    ng-click="setClickedRow($index,tarea)">
{{--                                    <td><input type="checkbox" ng-model ="tarea.hecho" ng-change="terminarTarea(tarea)"
                                               ng-true-value="1" ng-false-value="0">
                                    </td>--}}
                                    <td><% tarea.nombre %>
                                        <span ng-if="tarea.prioridad === 'normal'" class="badge alert-warning"><i class="fa fa-clock-o"></i></span>
                                    </td>

                                    <td></td>
                                </tr>


                                </tbody>
                            </table>
                          </div>

                            </div> <!-- fin row tabla 1!-->
                        </div>

                        </div>
                        {{--@include("partials.detallestarea")--}}

                        <div class="detallesDiv" ng-include src="template.url"></div>
                        <div class="modalListaDiv" ng-include="templatemodalLista.url"></div>
                        <div class="modalActividad" ng-include="templatemodalActividad.url"></div>
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
            <script src="//cdnjs.cloudflare.com/ajax/libs/angular-filter/0.5.5/angular-filter.min.js"></script>


                {!! HTML::script('/bower_resources/angular-bootstrap3-datepicker/dist/ng-bs3-datepicker.js') !!}
                {!! HTML::script('/bower_resources/angular-bootstrap/ui-bootstrap.min.js') !!}
                {!! HTML::script('/bower_resources/angular-file-upload/dist/angular-file-upload.min.js') !!}

                 <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.2.js"></script>


            {!! HTML::script('app/app.modules.js') !!}
            {!! HTML::script('app/siga/common/commonFilters.js') !!}
            {!! HTML::script('app/siga/sigaController.js') !!}
            {!! HTML::script('app/siga/sigaServices.js') !!}
            {!! HTML::script('app/siga/sigaFilters.js') !!}







@endsection
