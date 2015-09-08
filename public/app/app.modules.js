var app = angular.module('tareasApp', ['ng-bs3-datepicker','ui.bootstrap','angularFileUpload'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});/**
 * Created by ticbox on 18/07/2015.
 */
