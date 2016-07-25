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


//Route::get('ies/updateie/{id}','UserController@updateie');

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
Route::get('siga/timeline/{id}','SigaController@sigaambitoxciclo');
Route::get('siga/resumen','SigaController@sigausuario');
Route::get('admin/siga/timeline/{id}','SigaController@sigaambitoxciclo');
Route::get('admin/siga/resumen','SigaController@sigausuario');
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
Route::get('api/filesentrega/{id}/{axcid}/{en}','FilesController@filesentrega');
Route::get('api/uploadfile','FilesController@upload');
Route::post('api/uploadfile','FilesController@upload');
Route::get('api/filesxtarea/{id}','FilesController@filesxtarea');
Route::resource('files','FilesController');
//ZONA ADMIN
Route::group(['prefix'=>'admin', 'middleware'=> ['auth','is_admin'],'namespace' => 'admin'],   function() {

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
    Route::get('procedimientos/duplicar/{id}',[
        'as' => 'admin.procedimientos.duplicar', 'uses' =>'ProcedimientoController@duplicar'
    ]);
    Route::resource('actividades','ActividadController');

    Route::get('auditoria/{id}',[
        'as' => 'auditoria', 'uses' =>'AuditoriaController@index'
    ]);
    Route::get('auditoria/actividad/{actividad}',[
        'as' => 'auditoria', 'uses' =>'AuditoriaController@auditaractividad'
    ]);
    Route::post('auditoria/certificaractividad/{actividad}',[
        'as' => 'auditoria', 'uses' =>'AuditoriaController@certificaractividad'
    ]);
    Route::post('auditoria/quitarcertificacion/{actividad}',[
        'as' => 'auditoria', 'uses' =>'AuditoriaController@quitarcertificacion'
    ]);
/*    Route::post('auditoria/guardarnc',[
        'as' => 'auditoria', 'uses' =>'NcsController@store'
    ]);
    Route::post('auditoria/devolvernc',[
        'as' => 'auditoria', 'uses' =>'NcsController@update'
    ]);*/
    Route::resource('auditoria','AuditoriaController');
    Route::resource('usuariosxciclo','UsuariosxcicloController');
    //CICLOS

    Route::get('ciclos/activar/{id}',[
        'as' => 'admin.ciclos.activar', 'uses' => 'CicloController@activar'
    ]);
    Route::post('ciclos/storeambitoxciclo/',[
        'as' => 'admin.ciclos.storeambitoxciclo', 'uses' => 'CicloController@storeambitoxciclo'
    ]);
    Route::get('ciclos/reporteciclos/',[
        'as' => 'admin.ciclos.reporteciclos', 'uses' => 'ReportesController@ciclosgral'
    ]);
    Route::resource('ciclos','CicloController');
    //entregas
    Route::resource('entregas','EntregasController');
    Route::get('entregas/ciclo/{id}',[
        'as'=> 'admin.entregas.ciclo','uses'=>'EntregasController@ciclo'
    ]);
    Route::get('entregas/create/{id}/{id2}',[
        'as'=> 'admin.create.actividad','uses'=>'EntregasController@create'
    ]);
    //siga
/*    Route::get('siga/sigausuarios/',[
        'as' => 'siga.sigausuarios', 'uses' => 'SigaController@sigausuarios'
    ]);
    Route::get('siga/timeline/{id}',[
        'as' => 'siga.timeline', 'uses' => 'SigaController@sigaambitoxciclo'
    ]);*/
    Route::resource('seguimientos', 'SeguimientoController');
});
//FIN ZONA ADMIN

//ZONA AUDITORIA USUARIOS NO ADMIN

Route::get('auditoria',[
    'as' => 'auditoria', 'uses' => 'AuditoriaController@index'
]);
Route::get('auditoria/mostrarncs',[
    'as' => 'auditoria.mostrarncs', 'uses' => 'AuditoriaController@mostrarncs'
]);
Route::get('auditoria/veractividades/{id}',[
    'as' => 'auditoria.veractividades', 'uses' => 'AuditoriaController@veractividades'
]);

Route::get('auditoria/auditaractividad/{id}',[
    'as' => 'auditoria.auditaractividad', 'uses' => 'AuditoriaController@auditaractividad'
]);
Route::get('auditoria/showactividad/{id}',[
    'as' => 'auditoria.showactividad', 'uses' => 'AuditoriaController@showactividad'
]);
Route::post('auditoria/agregarseguimiento/{id}',[
    'as' => 'auditoria.agregarseguimiento', 'uses' => 'AuditoriaController@agregarseguimiento'
]);

Route::get('download', function() {

    $file = \App\Files::findOrfail(Input::get('file'));
    $headers = array(
        "Content-Type:$file->mime",
    );
    return Response::download($file->storage_path,$file->filename,$headers);
});
Route::resource('users','UserController');

Route::get('ncs/exportarncs/{id?}/{ver?}',[
    'uses' => 'NcsController@exportarncs'
]);
Route::get('ncs/exportartodasncs/{ver?}',[
    'uses' => 'NcsController@exportartodasncs'
]);

Route::resource('ncs','NcsController');
Route::get('devolverncsajax',[
    'as' => 'devolverncsajax', 'uses' => 'NcsController@devolverncsajax'
]);


Route::get('funcionarios/{id}','FuncionarioController@index');
Route::get('funcionarios/create/{id}','FuncionarioController@create');
Route::get('funcionarios/show/{id}','FuncionarioController@show');
Route::resource('funcionarios', 'FuncionarioController');

/*Route::get('listafuncionarios/{$id}',
    ['as'=>'listafuncionarios','uses'=>'FuncionarioController@index']);*/


Route::controllers([
    'eventos' => 'EventosController',
    'users' => 'UserController',
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


Route::post('api/register', 'TokenAuthController@register');
Route::post('api/authenticate', 'TokenAuthController@authenticate');
Route::get('api/authenticate/user', 'TokenAuthController@getAuthenticatedUser');

Route::post('ies/updateie/{id}','UserController@updateie');
/*Route::post('ies/updateie', [
    'as' => 'ies/updateie', 'uses' => 'UserController@updateie'
]);*/
Route::get('ies/actualizaries','UserController@actualizaries');
Route::get('ies/editie/{id}','UserController@editie');




