var app = angular.module('tareasApp');

app.filter('dateToISO', function() {
    return function(input) {
        input = new Date(input).toLocaleString();
        return input;
    };
});

app.filter('dateFormat', function($filter)
{
    return function(input)
    {
        if(input == null){ return ""; }

        var _date = $filter('date')(new Date(input), 'dd/MM/yyyy hh:mm');

        return _date.toLocaleString();

    };
});
