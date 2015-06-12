<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

//Route::get('calendar','UserController@calendar');

Route::get('eventos/edit/{id}','EventosController@edit');
Route::get('eventos/show/{id}','EventosController@show');
Route::get('calendar/{id}','EventosController@index');
Route::get('eventos/agenda','EventosController@agenda');
Route::get('eventos/agenda/{id}','EventosController@agenda');
Route::get('eventos/agendaexcel','EventosController@agendaexcel');
Route::get('eventos/agendaexcel/{id}','EventosController@agendaexcel');

Route::get('eventos/actividades','EventosController@actividades');
Route::post('eventos/actividades','EventosController@actividades');
//Route::get('eventos/actividades/{id}','EventosController@actividades');
Route::get('eventos/actividadesexcel','EventosController@actividadesexcel');
Route::get('eventos/actividadesexcel/{id}','EventosController@actividadesexcel');

//Route::get('eventos/destroy/{id}','EventosController@destroy');

Route::post('muro/crearmuro/','MuroController@crearmuro');
Route::post('muro/crearanuncio/','MuroController@crearanuncio');

//Route::get('users/perfil','UserController@perfil');
Route::resource('users','UserController');

Route::resource('calendar', 'EventosController');

Route::resource('muro','MuroController');

//Route::resource('calendar','Even')
Route::post('send', ['as' => 'send', 'uses' => 'MailController@send'] );
Route::get('contact', ['as' => 'contact', 'uses' => 'MailController@index'] );
Route::get('feedback', ['as' => 'feedback', 'uses' => 'MailController@feedback'] );



Route::controllers([
    'eventos' => 'EventosController',
    'users' => 'UserController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



Route::group(['prefix'=>'admin', 'middleware'=> ['auth','is_admin'],'namespace' => 'admin'],   function() {

/*    Route::get('users/calendar/{id?}', [
        'as' => 'calendar', 'uses' => 'UserController@calendar'
    ]);

    Route::post('users/calendar/', [
        'as' => 'calendar', 'uses' => 'UserController@calendar'
    ]);*/

    Route::get('users/misevento/{id?}', [
        'as' => 'misevento', 'uses' => 'UserController@misevento'
    ]);

    Route::get('muro/',[
        'as' => 'muro', 'uses' =>'UserController@muro'
    ]);
    Route::get('resumen',[
        'as' => 'resumen', 'uses' =>'UserController@resumen'
    ]);
    Route::get('resumen/{id}',[
        'as' => 'resumen', 'uses' =>'UserController@resumen'
    ]);

    Route::resource('users','UserController');

    Route::resource('programas','ProgramaController');

    Route::resource('ies', 'IeController');

    Route::resource('fichas', 'FichaController');


});

