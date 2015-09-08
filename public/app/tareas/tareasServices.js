var app = angular.module('tareasApp');



app.service('tareasService',function($http,$q){
    //var tareas = [];
    this.tareas = [];
    this.listaTareas = [];
    this.files = [];



    this.getAll = function(){
        var deferred = $q.defer();
        deferred.resolve($http.get('/api/tareas').//metodo para obligar a esperar la carga de los datos la primer vez
            success(function(data, status, headers, config) {
                this.tareas = data;
                //console.log(this.tareas);
                //console.log('los datos');
                //this.this.envio = new Date(this.this.envio).toISOString();
                //this.loading = false;

            }));
        return deferred.promise;
    };
    this.addTarea = function(tarea, lista) {
        this.loading = true;
        var deferred = $q.defer();
        $http.post('/api/tareas', {
            nombre: tarea,
            lista: lista
        }).success(function(data, status, headers, config) {
            this.tareas.push(data);
            deferred.resolve(data);
        });
        return deferred.promise;
    };

    this.updateTarea = function(tarea) {
        var deferred = $q.defer();
        //console.info(tarea);
        $http.put('/api/tareas/' + tarea.id, {
            nombre: tarea.nombre,
            descripcion: tarea.descripcion,
            entrega: tarea.entrega,
            recordar: tarea.recordar
        }).success(function(data, status, headers, config) {

            deferred.resolve(data);
            console.log("tarea actualizada");

        });
        return deferred.promise;
    };
    this.terminarTarea = function(tarea) {
        var deferred = $q.defer();
        $http.post('/api/terminar/' + tarea.id, {
            hecho: tarea.hecho
        }).success(function(data, status, headers, config) {
            deferred.resolve(data);
            console.log("Tarea terminada");

        });
        return deferred.promise;
    };


     this.deleteTarea = function(tarea,idx) {
         var deferred = $q.defer();
         console.log(tarea);
         console.info(idx);
         //this.tareas = this.tareas.filter('filter')(this.tareas, {id: tarea.id});

         $http.delete('/api/tareas/' + tarea.id)
         .success(function(data) {
            //this.tareas.splice(idx,1);
            deferred.resolve(data);
                 var index = this.tareas.indexOf(tarea);
                 if (index != -1) {
                     this.tareas.splice(index, 1);
                 }
            console.log("Tarea eliminada")

         });
         return deferred.promise;
     };
    this.getTareasxEstado = function(lista){
        return $http.get('api/numerotareaxestado/'+lista);
    };
    /*
    *
    * SECCION DE LISTAS
    * */

    this.addLista = function(lista) {
        var deferred = $q.defer();
        console.log(lista);
        $http.post('/api/listas', {
            nombre: lista.nombre,
            es_procedimiento: lista.es_procedimiento,
            activo:lista.activo
        }).success(function(data, status, headers, config) {
            this.listaTareas.push(data.lista);
            deferred.resolve(data);

        });
        return deferred.promise;
    };
    this.deleteLista = function(lista,idx){
        var deferred = $q.defer();
        $http.delete('api/listas/'+lista.id)
            .success(function(data){
                this.listaTareas.splice(idx,1);
                deferred.resolve(data);
            });
        return deferred.promise;

    };

    this.updateLista = function(lista){
        var deferred = $q.defer();
        $http.put('api/listas/'+lista.id,{
            nombre:lista.nombre,
            es_procedimiento:lista.es_procedimiento,
            activo:lista.activo
        }).success(function(data){
                deferred.resolve(data);
            });
        return deferred.promise;
    };

     this.getListas = function(){
       var deferred = $q.defer();
       $http.get('/api/listastareas')
        .success(function(data, status, headers, config){
               this.listaTareas = data;
          deferred.resolve(data);
        });
        return deferred.promise;
     };

    this.getTareasListaFirst = function(lista){ // la primer carga de la pagina
        var deferred = $q.defer();
        $http.get('/api/tareasxlista/' + lista).//metodo para obligar a esperar la carga de los datos la primer vez
            success(function(data, status, headers, config) {
                this.tareas = data;
                deferred.resolve(data);
                //return data;
                //console.log(data);
                //console.log('los datos');
                //this.this.envio = new Date(this.this.envio).toISOString();
                //this.loading = false;

            });
        return deferred.promise;
    };

    this.getTareasLista = function(lista){ // la primer carga de la pagina
        var deferred = $q.defer();
         $http.get('/api/tareasxlista/' + lista).//metodo para obligar a esperar la carga de los datos la primer vez
            success(function(data, status, headers, config) {
                this.tareas = data;
                deferred.resolve(data);

                //console.log(this.tareas);
                //console.log('los datos');
                //this.this.envio = new Date(this.this.envio).toISOString();
                //this.loading = false;

            });
        //return this.tareas;
        return deferred.promise;
    };

    /**
     *
     * ARCHIVOS
     * @param tarea
     * @returns {*}
     */
    //retorna los archivos de una tarea
    this.getfilesxtarea = function(tarea){
      var deferred = $q.defer();
        $http.get('/api/filesxtarea/'+tarea).
            success(function(data, status, headers, config){
                deferred.resolve(data);
            });
        return deferred.promise;
    };
    //retorna todos los archivos de un usuario
    this.getfilesxuser = function(){
        var deferred = $q.defer();
        $http.get('/api/files').
            success(function(data, status, headers, config){
                this.files = data;
                deferred.resolve(data);
            });
        return deferred.promise;
    };

    this.deletefile = function(file){
        var deferred = $q.defer();
        $http.delete('api/files/'+file.id)
            .success(function(data){
                var index = this.files.indexOf(file);
                if (index != -1) {
                    this.files.splice(index, 1);
                }
                deferred.resolve(data);
            });
        return deferred.promise;
    };

    this.isadmin = function(){
        var deferred = $q.defer();
        $http.get('/api/isadmin')
            .success(function(data){
                deferred.resolve(data);
            });
            return deferred.promise;
    };

    this.getcsfr = function(){
        var deferred = $q.defer();
        $http.get('/auth/token')
            .success(function(data){
                deferred.resolve(data);
            });
        return deferred.promise;
    };


    //return this.tareas;
})
