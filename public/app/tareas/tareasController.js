var app = angular.module('tareasApp');

app.controller('tareasController', ['$scope', '$log', '$modal','tareasService','FileUploader',function($scope, $log, $modal, tareasService,FileUploader) {


    $scope.template = null;
    $scope.tareas = [];
    $scope.listaTareas = [];
    $scope.files = [];
    $scope.mensaje = "";
    $scope.tareasterminadas = 0;
    $scope.loading = true;
    $scope.isadmin = false;
    $scope.templateTareas = {name:'listasTareas.html', url:'app/tareas/listasTareas.html'};
    $scope.templatemodalLista = {name:'modalLista.html',url:'app/tareas/modalLista.html'};
    $scope.templatemodalListaEdit = {name:'modalEditLista.html',url:'app/tareas/modalEditLista.html'};
    //$scope.loading = true;
    $scope.selectedRow = null;  // initialize our variable to null
    $scope.selectedLista = null;
    $scope.selectedRowLista = null;

    $scope.init = function() {
        console.log('entro al init');

        tareasService.isadmin().then(function(data){
            console.info(data);
            if(data == 0) {
                $scope.isadmin = false;
            }
            else {
                $scope.isadmin = true;
            }

        });

        $scope.loading = true;
        tareasService.getListas().then(function (data) { //retorna lista de tareas

            $scope.listaTareas = data;
            $scope.selectedLista = data[0];
            $scope.selectedRowLista = 0;
            //$scope.getTareasLista();
            tareasService.getfilesxuser().then(function(data){
                $scope.files = data;
            });

            tareasService.getAll().then(function(data){
                //console.log(data);
               $scope.tareas = data.data;
            });
            console.log($scope.isadmin);

        });


        $scope.loading = false;

    };

    $scope.setClickedRow = function(index,tarea) {  //function that sets the value of selectedRow to current index
        $scope.template = null;
        $scope.selectedRow = index;
        $scope.selectedTarea = tarea;
        $scope.template = {name:'detallesTareaView.html', url:'app/tareas/detallesTareaView.html'}
        console.log($scope.selectedTarea.id);
/*        tareasService.getfilesxtarea($scope.selectedTarea.id).then(function(data){
           $scope.files = data;
        });*/

    };
    $scope.setClickedRowLista = function(index,lista) {  //function that sets the value of selectedRow to current index
        $scope.loading = true;
        $scope.selectedRowLista = index;
        $scope.selectedLista = lista;
        //$scope.getTareasLista();
        $scope.template = null;
        $scope.loading = false;
        $scope.selectedRow = null;  // initialize our variable to null

    };

    $scope.getTareasLista = function () {
        tareasService.getTareasLista($scope.selectedLista.id).then(function(data){
            $scope.tareas = data;
        });
    };

    $scope.getTareasxEstado =  function(){
        tareasService.getTareasxEstado($scope.selectedLista.id).then(function(data){
            $scope.tareasxestado = data.data;
        });
    };

    $scope.addTarea = function(){
        $scope.loading = true;

        tareasService.addTarea($scope.tarea.nombre, $scope.selectedLista.id);
        $scope.tarea = '';
        $scope.loading = false;
        $scope.selectedLista.numero_tareas++;
    };

    $scope.addLista = function(lista){
        $scope.loading = true;


        tareasService.addLista(lista).then(function(data){
            $scope.mensaje = data.mensaje;
            //$scope.listaTareas.push(data.lista);
        });
        lista.nombre = "";
        $scope.loading = false;
    };
    $scope.deleteLista = function(index,lista){
        $scope.loading = true;
        $scope.selectedRowLista = index;
        $scope.selectedLista = lista;
        tareasService.deleteLista($scope.selectedLista,index).then(function(data){
            $scope.mensaje = data.mensaje;
        });

        //$scope.tarea = '';
        $scope.loading = false;
    };
    $scope.updatelista = function(){
        $scope.loading = true;
        tareasService.updateLista($scope.selectedLista).then(function(data){
            $scope.mensaje = data.mensaje;
        });
        $scope.loading = false;
    };

    $scope.updateTarea = function(){
        $scope.loading = true;
        tareasService.updateTarea($scope.selectedTarea).then(function(data){
            $scope.mensaje = data.mensaje;

        });

        //$scope.mensaje = respuesta;
        $scope.loading = false;
    };

    $scope.terminarTarea = function(tarea){
        $scope.loading = true;

        tareasService.terminarTarea(tarea).then(function(data){
            $scope.mensaje = data.mensaje;



        });

        //$scope.mensaje = respuesta;
        $scope.loading = false;
        if(tarea.hecho == 1)
            $scope.selectedLista.numero_tareas--;
        else
            $scope.selectedLista.numero_tareas++;
    };

    $scope.deleteTarea = function(){
        $scope.loading = true;

        tareasService.deleteTarea($scope.selectedTarea,$scope.selectedRow).then(function(data){
            $scope.mensaje = data.mensaje;
        });
        $scope.loading = false;
        $scope.selectedLista.numero_tareas--;



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
        fileItem.formData.push({
            tarea_id: $scope.selectedTarea.id,
            descripcion: 'N/A',
            tipo:   'evidencia'
        });
        //console.info('onAfterAddingFile', fileItem);
    };
    uploader.onCompleteItem = function(fileItem, response, status, headers) {
        //console.info('onCompleteItem', fileItem, response, status, headers);
       // console.info('onCompleteItem', response.file);
        $scope.files.push(response.file);

    };

    $scope.deleteFile = function(file){
        tareasService.deletefile(file).then(function(data){
           $scope.mensaje = data.mensaje;
        });
    };

/*
* manejo de modal
*
* */
    $scope.items = $scope.selectedLista;
    $scope.animationsEnabled = true;

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
                    return $scope.selectedLista;
                },
                is_admin: function(){
                    return $scope.isadmin;
                }
            }
        });

        modalInstance.result.then(function (lista) {
            $scope.selectedLista.nombre = lista.nombre;
            console.info(lista.es_procedimiento);
            $scope.selectedLista.es_procedimiento = lista.es_procedimiento;
            $scope.selectedLista.activo = lista.activo;
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