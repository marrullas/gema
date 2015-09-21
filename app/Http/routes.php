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

Route::get('/auth/token', 'Auth\AuthController@token');

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
Route::get('eventos/acumuladoxficha','EventosController@acumuladoxficha');
Route::post('eventos/acumuladoxficha','EventosController@acumuladoxficha');
Route::get('eventos/acumuladoxfichaexcel','EventosController@acumuladoxfichaexcel');


//Route::get('eventos/actividades/{id}','EventosController@actividades');

Route::get('eventos/actividadesexcel','EventosController@actividadesexcel');
Route::get('eventos/actividadesexcel/{id}','EventosController@actividadesexcel');

//Route::get('eventos/destroy/{id}','EventosController@destroy');

Route::post('muro/crearmuro/','MuroController@crearmuro');
Route::post('muro/crearanuncio/','MuroController@crearanuncio');

//Route::get('users/perfil','UserController@perfil');
Route::resource('users','UserController');
Route::get('api/isadmin','UserController@isadmin');

Route::resource('calendar', 'EventosController');

Route::resource('muro','MuroController');

Route::resource('message','MessageController');

Route::get('actas/todas/','ActaController@todas');
Route::resource('actas', 'ActaController');



Route::resource('tareas','TareaController');
Route::resource('api/tareas','TareaController');
Route::get('api/tareas','TareaController@tareas');
Route::post('api/terminar/{id}','TareaController@terminar');
Route::get('api/tareasxlista/{id}','TareaController@tareasxlista');
Route::get('api/numerotareaxestado/{id}','TareaController@numerotareaxestado');

//listas
Route::resource('api/listas','ListasController');
Route::resource('listas','ListasController');
Route::get('api/listastareas','ListasController@lista');


//SIGA
Route::resource('siga','SigaController');
Route::get('api/siga/lista','SigaController@lista');
Route::get('api/siga/actividades/{id}','SigaController@actividades');

//procedimientos
Route::get('api/procedimientos/lista','ProcedimientoController@lista');
Route::resource('api/procedimientos','ProcedimientoController');

//Route::resource('api/listaprocedimiento','ProcedimientoController');

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

//manejo de archivos
Route::resource('api/files','FilesController');
Route::get('api/filesentrega/{id}/{en}','FilesController@filesentrega');
Route::get('api/uploadfile','FilesController@upload');
Route::post('api/uploadfile','FilesController@upload');
Route::get('api/filesxtarea/{id}','FilesController@filesxtarea');
Route::resource('files','FilesController');

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

    Route::get('actividades/create/{$id}',[
        'as' => 'admin.actividades.create', 'uses' => 'ActividadController@create'
    ]);

    Route::resource('users','UserController');

    Route::resource('programas','ProgramaController');

    Route::resource('ies', 'IeController');

    Route::resource('fichas', 'FichaController');

    Route::resource('procedimientos','ProcedimientoController');
    Route::resource('actividades','ActividadController');
    Route::resource('ciclos','CicloController');
    Route::get('ciclos/activar/{id}',[
        'as' => 'admin.ciclos.activar', 'uses' => 'CicloController@activar'
    ]);
    Route::post('ciclos/storeambitoxciclo/',[
        'as' => 'admin.ciclos.storeambitoxciclo', 'uses' => 'CicloController@storeambitoxciclo'
    ]);





});

Route::get('download', function() {

    $file = \App\Files::findOrfail(Input::get('file'));
    $headers = array(
        "Content-Type:$file->mime",
    );
    return Response::download($file->storage_path,$file->filename,$headers);
});
Route::resource('users','UserController');

Route::controllers([
    'eventos' => 'EventosController',
    'users' => 'UserController',
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

