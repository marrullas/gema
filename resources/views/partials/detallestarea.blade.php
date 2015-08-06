<!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->

<div class="col-md-3 col-sm-6 col-xs-6">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <h3>DETALLES</h3>
    <h2>Creador por:</h2><h3 ng-cloak><% selectedTarea.creadopor.full_name %></h3>

    <!-- formulario -->
    <form>
        <div class="form-group">
            <label for="nombre">Tarea</label>
            <input class="form-control" type='text' ng-model="selectedTarea.nombre">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control col-md-4" ng-model="selectedTarea.descripcion"></textarea>
        </div>
        <label for="enviado">Enviado:</label>
        <% selectedTarea.envio | dateFormat %>
        <div class="form-group">
            <label for="nombre">Fecha limite</label>
            <div class="input-group date" id="datetimepicker2">
                {{--<input class="form-control" type='text' ng-model="selectedTarea.entrega">--}}
                <ng-bs3-datepicker id="date2" data-ng-model="selectedTarea.entrega" datetime="dd/MM/yyyy hh:mm" language="es" date-format="DD/MM/YYYY HH:mm"/>
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
            </div>
        </div>
        <div class="form-group">
            <label for="nombre">Enviar recordatorio</label>
            <div class="input-group date" id="datetimepicker1">
                {{--<input class="form-control" type='text' ng-model="selectedTarea.recordar">--}}
                <ng-bs3-datepicker id="date2" ng-model='selectedTarea.recordar' language="es" date-format="DD/MM/YYYY HH:mm"/>
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info" ng-click="updateTarea()">Guardar
            </button>
        </div>

    </form>


</div><!-- /col-lg-3 -->
