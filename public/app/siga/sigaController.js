var app = angular.module('sigaApp');

app.controller('sigaController', ['$scope', '$log', '$modal','sigaService','FileUploader',function($scope, $log, $modal, sigaService,FileUploader) {


    $scope.template = null;
    $scope.tareas = [];
    $scope.listaTareas = [];
    $scope.files = [];
    $scope.mensaje = "";
    $scope.tareasterminadas = 0;
    $scope.loading = true;
    $scope.isadmin = false;
    $scope.cargarfiles = true;
    $scope.templateTareas = {name:'listasTareas.html', url:'app/siga/listasActividades.html'};
    $scope.templatemodalActividad = {name:'modalActividad.html', url:'app/siga/modalActividad.html'};
    $scope.templatemodalLista = {name:'modalLista.html',url:'app/siga/modalLista.html'};
    $scope.templatemodalListaEdit = {name:'modalEditLista.html',url:'app/siga/modalEditLista.html'};
    //$scope.loading = true;
    $scope.selectedRow = null;  // initialize our variable to null
    $scope.selectedProcedimiento = null;
    $scope.selectedRowProcedimiento = null;

    $scope.init = function() {
        console.log('entro al init');

        sigaService.isadmin().then(function(data){
            console.info(data);
            if(data == 0) {
                $scope.isadmin = false;
            }
            else {
                $scope.isadmin = true;
            }

        });

        $scope.loading = true;
        sigaService.getProcedimientos().then(function (data) { //retorna lista de procedimientos
            console.log(data);
            //se asigna los datos del primer procedmiento
            $scope.listaProcedimientos = data;
            $scope.selectedProcedimiento = data[0];
            $scope.selectedRowProcedimiento = 0;
            //se cargan las actividades
            $scope.getActividadesLista();

        });


        $scope.loading = false;

    };

    $scope.setClickedRow = function(index,tarea) {  //function that sets the value of selectedRow to current index
        $scope.template = null;
        $scope.selectedRow = index;
        $scope.selectedTarea = tarea;
        $scope.loading = true;

        sigaService.getfilesxentrega($scope.selectedTarea.id,$scope.selectedProcedimiento.ambitosxciclo_id).then(function(data){
            $scope.files = data;
            $scope.validarnumerofiles();
        });

        $scope.template = {name:'detallesTareaView.html', url:'app/siga/detallesTareaView.html'}
        $scope.loading = false;

        console.log($scope.selectedTarea.ciclo.ambito_id);
/*        tareasService.getfilesxtarea($scope.selectedTarea.id).then(function(data){
           $scope.files = data;
        });*/

    };
    //carga las actividades del procedimiento
    $scope.setClickedRowprocedimiento = function(index,lista) {  //function that sets the value of selectedRow to current index
        $scope.loading = true;
        $scope.selectedRowProcedimiento = index;
        $scope.selectedProcedimiento = lista;
        console.log('selecciona lista');
        $scope.getActividadesLista();
        $scope.template = null;
        $scope.loading = false;
        $scope.selectedRow = null;  // initialize our variable to null

    };

    $scope.getActividadesLista = function () {
        console.log($scope.selectedProcedimiento);
       sigaService.getActividadesLista($scope.selectedProcedimiento.cicloid).then(function(data){
           //console.log(data);
            $scope.tareas = data;
        });
    };

    $scope.getTareasxEstado =  function(){

        sigaService.getActividadesLista($scope.selectedProcedimiento.id).then(function(data){
            $scope.tareasxestado = data.data;
        });
    };

    $scope.addTarea = function(){
        $scope.loading = true;

        sigaService.addTarea($scope.tarea.nombre, $scope.selectedProcedimiento.id);
        $scope.tarea = '';
        $scope.loading = false;
        $scope.selectedProcedimiento.numero_tareas++;
    };

    $scope.addLista = function(lista){
        $scope.loading = true;


        sigaService.addLista(lista).then(function(data){
            $scope.mensaje = data.mensaje;
            //$scope.listaTareas.push(data.lista);
        });
        lista.nombre = "";
        $scope.loading = false;
    };
    $scope.deleteLista = function(index,lista){
        $scope.loading = true;
        $scope.selectedRowProcedimiento = index;
        $scope.selectedProcedimiento = lista;
        sigaService.deleteLista($scope.selectedProcedimiento,index).then(function(data){
            $scope.mensaje = data.mensaje;
        });

        //$scope.tarea = '';
        $scope.loading = false;
    };
    $scope.updatelista = function(){
        $scope.loading = true;
        sigaService.updateLista($scope.selectedProcedimiento).then(function(data){
            $scope.mensaje = data.mensaje;
        });
        $scope.loading = false;
    };

    $scope.updateTarea = function(){
        $scope.loading = true;
        sigaService.updateTarea($scope.selectedTarea).then(function(data){
            $scope.mensaje = data.mensaje;

        });

        //$scope.mensaje = respuesta;
        $scope.loading = false;
    };

    $scope.terminarTarea = function(tarea){
        $scope.loading = true;

        sigaService.terminarTarea(tarea).then(function(data){
            $scope.mensaje = data.mensaje;



        });

        //$scope.mensaje = respuesta;
        $scope.loading = false;
        if(tarea.hecho == 1)
            $scope.selectedProcedimiento.numero_tareas--;
        else
            $scope.selectedProcedimiento.numero_tareas++;
    };

    $scope.deleteTarea = function(){
        $scope.loading = true;

        sigaService.deleteTarea($scope.selectedTarea,$scope.selectedRow).then(function(data){
            $scope.mensaje = data.mensaje;
        });
        $scope.loading = false;
        $scope.selectedProcedimiento.numero_tareas--;



    };

    /**
     * control archivos
     * @type {string}
     */
    var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');// se requiere para que deje subir archivos
    var uploader = $scope.uploader = new FileUploader({
        url: '/api/uploadfile',
        autoUpload:false,
        removeAfterUpload:true,
            headers : {
            'X-CSRF-TOKEN': csrf_token // X-CSRF-TOKEN is used for Ruby on Rails Tokens
        },

    });

    uploader.onAfterAddingFile = function(fileItem) {
        console.log($scope.selectedProcedimiento.ambitosxciclo_id);
        fileItem.formData.push({
            codigo: $scope.selectedTarea.id,
            descripcion: 'N/A',
            tipodocumento_id: '3',
            prefijo:'EN',
            ambitosxciclo_id:$scope.selectedProcedimiento.ambitosxciclo_id
        });
        //console.info('onAfterAddingFile', fileItem);
    };
    uploader.onCompleteItem = function(fileItem, response, status, headers) {
        $scope.cargarfiles = false;
        //console.info('onCompleteItem', fileItem, response, status, headers);
       // console.info('onCompleteItem', response.file);
        $scope.files.push(response.file);
        $scope.validarnumerofiles();

    };

    $scope.deleteFile = function(file){
        $scope.cargarfiles = false;
        sigaService.deletefile(file).then(function(data){
           $scope.mensaje = data.mensaje;
            $scope.validarnumerofiles();
        });
    };
    $scope.validarnumerofiles = function () {
        //validamos el numero de archivos permitidos para la actividad
        $scope.cargarfiles = (files.length < $scope.selectedTarea.numeroarchivos);
    };

/*
* manejo de modal
*
* */


    $scope.items = $scope.selectedProcedimiento;
    $scope.animationsEnabled = true;
    $scope.openActividades = function (size) {
        console.log($scope.isadmin);
        var modalInstance = $modal.open({
            animation: $scope.animationsEnabled,
            templateUrl: 'modalActividad.html',
            //controller: 'ModalInstanceCtrl',
            size: size

        });
    };
    $scope.open = function (size) {
        console.log($scope.isadmin);
        var modalInstance = $modal.open({
            animation: $scope.animationsEnabled,
            templateUrl: 'modalEditLista.html',
            controller: 'ModalInstanceCtrl',
            size: size,
            is_admin:$scope.isadmin,
            resolve: {
                items: function () {
                    return $scope.selectedProcedimiento;
                },
                is_admin: function(){
                    return $scope.isadmin;
                }
            }
        });

        modalInstance.result.then(function (lista) {
            $scope.selectedProcedimiento.nombre = lista.nombre;
            console.info(lista.es_procedimiento);
            $scope.selectedProcedimiento.es_procedimiento = lista.es_procedimiento;
            $scope.selectedProcedimiento.activo = lista.activo;
            $scope.updatelista();
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };

    $scope.toggleAnimation = function () {
        $scope.animationsEnabled = !$scope.animationsEnabled;
    };

    $scope.init();


}]);

app.controller('ModalInstanceCtrl', ['$scope', '$modalInstance', 'items', 'is_admin',function ($scope, $modalInstance, items, is_admin) {

    console.info(items);
    $scope.lista = items;
    if(!angular.isNumber($scope.lista.es_procedimiento)) {
        $scope.lista.es_procedimiento = ($scope.lista.es_procedimiento === true ? 1 : 0);
    }
    if(!angular.isNumber($scope.lista.activo)) {
        $scope.lista.activo = ($scope.lista.activo === true ? 1 : 0);
    }
    $scope.is_admin = is_admin;


    $scope.ok = function () {
        $modalInstance.close($scope.lista);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
}]);

app.directive('ngConfirmClick', [
    function(){
        return {
            link: function (scope, element, attr) {
                //alert('por aqui pase');
                var msg = attr.ngConfirmClick || "Are you sure?";
                var clickAction = attr.confirmedClick;
                element.bind('click',function (event) {
                    if ( window.confirm(msg) ) {
                        scope.$eval(clickAction)
                    }
                });
            }
        };
    }]);