var app = angular.module('tareasApp');

app.controller('tareasController', ['$scope', '$log', '$modal','tareasService',function($scope, $log, $modal, tareasService) {

    $scope.tareas = [];
    $scope.listaTareas = [];
    $scope.items = [];
    $scope.mensaje = "";
    $scope.listaOriginalnombre = "";
    $scope.tareasterminadas = 0;
    $scope.loading = true;
    $scope.templateTareas = {name:'listasTareas.html', url:'app/tareas/listasTareas.html'};
    $scope.templatemodalLista = {name:'modalLista.html',url:'app/tareas/modalLista.html'};
    $scope.templatemodalListaEdit = {name:'modalEditLista.html',url:'app/tareas/modalEditLista.html'};


/*
    tareasService.getAll().then(function(data){
        $scope.tareas = data.data;
        //console.log(data.data);
    });
    */
    $scope.loading = false;

    $scope.init = function() {
        tareasService.getListas().then(function(data) { //retorna lista de tareas

            $scope.selectedLista = data[0];
            $scope.selectedRowLista = 0;
            $scope.listaTareas = data;
            $scope.getTareasListaFirst();
            $scope.listaOriginalnombre = $scope.selectedLista.nombre;

        });

        //$scope.loading = true;
        $scope.selectedRow = null;  // initialize our variable to null
        $scope.setClickedRow = function(index,tarea) {  //function that sets the value of selectedRow to current index
            $scope.selectedRow = index;
            $scope.selectedTarea = tarea;
            $scope.template = {name:'detallesTareaView.html', url:'app/tareas/detallesTareaView.html'}

        };
        $scope.setClickedRowLista = function(index,lista) {  //function that sets the value of selectedRow to current index
            $scope.selectedRowLista = index;
            $scope.selectedLista = lista;
            $scope.getTareasLista();

        };
        //trae las tareas que pertenecen a la lista seleccionada en la primer carga de la pagina
        $scope.getTareasListaFirst = function () {
           tareasService.getTareasListaFirst($scope.selectedLista.id).then(function(data){
               $scope.tareas = data;
           });
            //console.log($scope.tareas);



        };

        $scope.getTareasLista = function () {
            tareasService.getTareasLista($scope.selectedLista.id).then(function(data){
                $scope.tareas = data.data;
               // console.log(data);
            });
        };


        $scope.getTareasxEstado =  function(){
            tareasService.getTareasxEstado($scope.selectedLista.id).then(function(data){
               $scope.tareasxestado = data.data;

            });
        };

    };

    $scope.listaOriginal = function(nombre){

       // $scope.$apply(function(){
            $scope.listaOriginalnombre = nombre;
       // });

        alert($scope.listaOriginalnombre);
    };


    /*
     *
     * MANEJO DE LISTAS
     *
     * */

    $scope.addLista = function(nombre){
        $scope.loading = true;
        tareasService.addLista(nombre);
        $scope.loading = false;
    };
    $scope.deleteLista = function(index,lista){
        $scope.loading = true;
        $scope.selectedRowLista = index;
        $scope.selectedLista = lista;
        tareasService.deleteLista(lista,index).then(function(data){
            $scope.mensaje = data.mensaje;
        });
        $scope.loading = false;
    };
    $scope.updatelista = function(){
        $scope.loading = true;
        tareasService.updateLista($scope.selectedLista).then(function(data){
            $scope.mensaje = data.mensaje;
        });
        $scope.loading = false;
    };
/*
 *
  * MANEJO DE TAREAS
  *
  * */
    $scope.addTarea = function(){
        $scope.loading = true;
        tareasService.addTarea($scope.tarea.nombre, $scope.selectedLista.id);
        $scope.tarea = '';
        $scope.loading = false;
        $scope.selectedLista.numero_tareas++;
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

    $scope.listasTareas = function(){
      $scope.loading = true;
        tareasService.getListas().then(function(data){
           $scope.listaTareas = data;
        });
    };



/*
* manejo de modal
*
* */
    $scope.items = $scope.selectedLista;
    $scope.animationsEnabled = true;

    $scope.open = function (size) {
        var modalInstance = $modal.open({
            animation: $scope.animationsEnabled,
            templateUrl: 'modalEditLista.html',
            controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {
                items: function () {
                    return $scope.selectedLista;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {
            $scope.selectedLista.nombre = selectedItem;
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
app.directive('ngConfirmClick', [
    function(){
        return {
            link: function (scope, element, attr) {
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


app.controller('ModalInstanceCtrl', function ($scope, $modalInstance, items) {
    $scope.nombreLista = items.nombre;
    $scope.ok = function () {
        $modalInstance.close($scope.nombreLista);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});