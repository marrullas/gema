var app = angular.module('tareasApp', ['ng-bs3-datepicker','ui.bootstrap','angularFileUpload'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

var app = angular.module('sigaApp', ['ng-bs3-datepicker','ui.bootstrap','angularFileUpload','angular.filter'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }]);