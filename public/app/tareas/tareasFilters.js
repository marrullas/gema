/**
 * Created by ticbox on 18/07/2015.
 */
var app = angular.module('tareasApp');
app.filter('hechoLista', function () {
    return function (items, lista, hecho) {
        // do a crazy loop
        var filtered = [];


        angular.forEach(items,function(item){
            if(item.lista == lista && item.hecho==hecho ){
                filtered.push(item);
            }
        });
        return filtered;
    };
});