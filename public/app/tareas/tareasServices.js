var app = angular.module('tareasApp');



app.service('tareasService',function($http,$q){
    //var tareas = [];
    this.tareas = [];
    this.listasTareas = [];



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
            //hecho: '0'
            //done: this.tarea.done
        }).success(function(data, status, headers, config) {
            this.tareas.push(data);
            deferred.resolve(data);
            //return data;
           // this.tarea = '';
            //console.log(data);
            //this.tarea.hecho = 0;
            //this.loading = false;

        });
        return deferred.promise;
    };

    this.updateTarea = function(tarea) {
        var deferred = $q.defer();
        $http.put('/api/tareas/' + tarea.tarea_id, {
            nombre: tarea.nombre,
            descripcion: tarea.descripcion,
            entrega: tarea.entrega,
            recordar: tarea.recordar
            //done: this.tarea.done
        }).success(function(data, status, headers, config) {
            //tarea = data;
            //console.log(data);
            deferred.resolve(data);
            console.log("tarea actualizada");

        });
        return deferred.promise;
    };
    this.terminarTarea = function(tarea) {
        var deferred = $q.defer();
        $http.post('/api/terminar/' + tarea.tarea_id, {
            hecho: tarea.hecho
        }).success(function(data, status, headers, config) {
            deferred.resolve(data);
            console.log("Tarea terminada");

        });
        return deferred.promise;
    };


     this.deleteTarea = function(tarea,idx) {
         var deferred = $q.defer();
         $http.delete('/api/tareas/' + tarea.tarea_id)
         .success(function(data) {
            this.tareas.splice(idx,1);
            deferred.resolve(data);
            console.log("Tarea eliminada")

         });
         return deferred.promise;
     };
    this.getTareasxEstado = function(lista){
        return $http.get('api/numerotareaxestado/'+lista);
    }
    /*
    *
    * SECCION DE LISTAS
    * */

    this.addLista = function(lista) {
        this.loading = true;
        var deferred = $q.defer();
        console.log(lista);
        $http.post('/api/listas', {
            nombre: lista
            //hecho: '0'
            //done: this.tarea.done
        }).success(function(data, status, headers, config) {
            this.listasTareas.push(data);
            deferred.resolve(data);
            //return data;
            // this.tarea = '';
            //console.log(data);
            //this.tarea.hecho = 0;
            //this.loading = false;

        });
        return deferred.promise;
    };
    this.deleteLista = function(lista,idx){
        var deferred = $q.defer();
        $http.delete('api/listas/'+lista.id)
            .success(function(data){
                this.listasTareas.splice(idx,1);
                deferred.resolve(data);
            });
        return deferred.promise;

    };

    this.updateLista = function(lista){
        var deferred = $q.defer();
        $http.put('api/listas/'+lista.id,{
            nombre:lista.nombre
        }).success(function(data){
                deferred.resolve(data);
            });
        return deferred.promise;
    };

     this.getListas = function(){
       var deferred = $q.defer();
       $http.get('/api/listastareas')
        .success(function(data){
               this.listasTareas = data;
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
        //var deferred = $q.defer();
         return $http.get('/api/tareasxlista/' + lista);//metodo para obligar a esperar la carga de los datos la primer vez
            /*success(function(data, status, headers, config) {
                this.tareas = data;
                //deferred.resolve(data);

                console.log(this.tareas);
                //console.log('los datos');
                //this.this.envio = new Date(this.this.envio).toISOString();
                //this.loading = false;

            });
        return this.tareas;*/
        //return deferred.promise;
    };


    //return this.tareas;
})
