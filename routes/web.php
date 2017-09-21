<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/****************************************************|
|----------------------------------------------------| 
|            P A Q U E T E  P E R S O N A            |
|----------------------------------------------------|
*****************************************************/
Route::get('persona/{ci}/report',	['as' => 'persona.report',	'uses' => 'PersonaController@report']);	
Route::get('persona/report{ci}',	['as' => 'persona.pdf',	'uses' => 'PersonaController@pdf']);	
Route::get('persona/generarpdf',								'PersonaController@generarpdf');

Route::get('persona/personas',									'PersonaController@listaPersonas');
Route::get('persona/searchPersonas/',						'PersonaController@searchPersonas');
Route::get('persona/PersonasPaginatesearch/',		'PersonaController@searchPersonasPaginate');

Route::get('persona/noMiembros',								'PersonaController@listaNoMiembros');
Route::get('persona/searchNoMiembros/',					'PersonaController@searchNoMiembros');
Route::get('persona/searchNoMiembrosPaginate/',	'PersonaController@searchNoMiembrosPaginate');

Route::get('persona/edit/{ci}',									'PersonaController@edit');
Route::get('persona/report/{ci}',								'PersonaController@report');

Route::resource('persona',											'PersonaController');

/****************************************************|
|----------------------------------------------------| 
|            P A Q U E T E  M I E M B R O            |
|----------------------------------------------------|
*****************************************************/
Route::get('miembro/searchMiembros/','MiembroController@searchMiembros');
Route::get('miembro/miembrosPaginateSearch/','MiembroController@miembrosPaginateSearch');
Route::delete('/{ci}', 'MiembroController@destroy');

Route::get('telefonos/{ci}', 'TelefonoController@index');
Route::get('telefono/agregarTelefono/{ci}/{nombre}', 'TelefonoController@agregarTelefono')->name('agregarTelefono');
Route::post('telefono/guardarTelefono/{ci}','TelefonoController@store')->name('guardarTelefono');

Route::get('trabajos/{ci}', 'TrabajoController@index');
Route::get('trabajo/agregarTrabajo/{ci}/{nombre}', 'TrabajoController@agregarTrabajo')->name('agregarTrabajo');
Route::post('trabajo/guardarTrabajo/{ci}','TrabajoController@store')->name('guardarTrabajo');

Route::get('miembro/bautizados','MiembroController@bautizados');
Route::get('miembro/searchBautizados/','MiembroController@searchBautizados');
Route::get('miembro/bautizadosPaginateSearch/','MiembroController@bautizadosPaginateSearch');

Route::get('miembro/noBautizados','MiembroController@noBautizados');
Route::get('miembro/searchNoBautizados/','MiembroController@searchNoBautizados');
Route::get('miembro/noBautizadosPaginateSearch/','MiembroController@noBautizadosPaginateSearch');

Route::get('miembro/conMinisterio','MiembroController@conMinisterio');
Route::get('miembro/searchConMinisterio/','MiembroController@searchConMinisterio');
Route::get('miembro/conMinisterioPaginateSearch/','MiembroController@conMinisterioPaginateSearch');

Route::get('miembro/sinMinisterio','MiembroController@sinMinisterio');
Route::get('miembro/searchSinMinisterio/','MiembroController@searchSinMinisterio');
Route::get('miembro/sinMinisterioPaginateSearch/','MiembroController@sinMinisterioPaginateSearch');

Route::get('bautismo/searchBautismo/','BautismoController@searchBautismo');
Route::get('bautismo/bautismoPaginateSearch/','BautismoController@bautismoPaginateSearch');

Route::get('ministerio/searchMinisterio/','MinisterioController@searchMinisterio');
Route::get('ministerio/ministerioPaginateSearch/','MinisterioController@ministerioPaginateSearch');

Route::resource('telefono','TelefonoController');
Route::resource('trabajo','TrabajoController');
Route::resource('ministerio','MinisterioController');
Route::resource('bautismo','BautismoController');
Route::resource('miembro','MiembroController');

/****************************************************|
|----------------------------------------------------| 
|         P A Q U E T E  E N C U E N T R O           |
|----------------------------------------------------|
*****************************************************/
Route::get('encuentro/searchEncuentro/','EncuentroController@searchEncuentro');
Route::get('encuentro/encuentroPaginateSearch/','EncuentroController@encuentroPaginateSearch');
Route::get('encuentro/habilitados/{encuentro}','EncuentroController@habilitados')->name('encuentro.habilitados');
Route::get('encuentro/searchHabilitados/','EncuentroController@searchHabilitados');
Route::get('encuentro/habilitadosPaginateSearch/','EncuentroController@habilitadosPaginateSearch');

Route::get('prerequisito/lista/{encuentro}','PrerequisitoController@prerequisitos')->name('prerequisito.lista');
Route::get('prerequisito/editar/{encuentro}/{idpre}','PrerequisitoController@editar')->name('prerequisito.editar');
Route::get('prerequisito/agregar/{encuentro}','PrerequisitoController@agregar')->name('prerequisito.agregar');
Route::post('prerequisito/guardar/{encuentro}','PrerequisitoController@store')->name('prerequisito.guardar');

Route::get('versionencuentro/lista/{encuentro}','VersionEncuentroController@versiones')->name('versiones.lista');
Route::get('versionencuentro/agregar/{encuentro}','VersionEncuentroController@create')->name('versiones.agregar');
Route::post('versiones/guardar/{encuentro}','VersionEncuentroController@store')->name('versiones.guardar');
Route::get('versiones/editar/{version}/{encuentro}','VersionEncuentroController@edit')->name('versiones.editar');
Route::put('versiones/actualizar/{version}/{encuentro}','VersionEncuentroController@update')->name('versiones.update');
Route::delete('versiones/destroy/{version}/{encuentro}','VersionEncuentroController@destroy')->name('versiones.destroy');
Route::get('versiones/searchVersiones/','VersionEncuentroController@searchVersiones');
Route::get('versiones/versionesPaginateSearch/','VersionEncuentroController@versionesPaginateSearch');
Route::get('versiones/searchHabilitados/','VersionEncuentroController@searchHabilitados');
Route::get('versiones/habilitadosPaginateSearch/','VersionEncuentroController@habilitadosPaginateSearch');

Route::get('versionencuentro/listaAsistentes/{version}/{encuentro}','VersionEncuentroController@asistentes')->name('asistentes');
Route::get('versionencuentro/agregarAsistente/{version}/{encuentro}','VersionEncuentroController@agregarAsistente')->name('addAsistentes');
Route::post('versiones/guardarAsist/{version}/{encuentro}/{fecha}/{lugar}',
						'VersionEncuentroController@storeAsistente')->name('guardarAsistente');
Route::delete('versionencuentro/delAsistentes/{version}/{miembro}/{encuentro}','VersionEncuentroController@destroyAsist')->name('Asist.destroy');
Route::get('versiones/searchAsistentes/','VersionEncuentroController@searchAsistentes');
Route::get('versiones/asistentesPaginateSearch/','VersionEncuentroController@asistentesPaginateSearch');


Route::resource('versionencuentro','VersionEncuentroController');
Route::resource('prerequisito','PrerequisitoController');
Route::resource('encuentro','EncuentroController');

/****************************************************|
|----------------------------------------------------|
|            P A Q U E T E  C E L U L A              |
|----------------------------------------------------|
 *****************************************************/
Route::get('celula/informes/{numero}/{cilider}','CelulaController@show')->name('celula.mostrar');
Route::get('celula/searchCelula/','CelulaController@searchCelula');
Route::get('celula/celulaPaginateSearch/','CelulaController@celulaPaginateSearch');

Route::get('informe/agregar/{cilider}/{nrocelula}','InformeController@create')->name('agregarInforme');
Route::get('informe/editar/{id}/{nrocelula}','InformeController@edit')->name('informe.editar');
Route::put('informe/actualizar/{id}/{nrocelula}','InformeController@update')->name('informe.actualizar');
Route::post('informe/guardar/{nrocelula}','InformeController@store')->name('informe.guardar');
Route::get('informe/searchInforme/','InformeController@searchInforme');
Route::get('informe/informePaginateSearch/','InformeController@informePaginateSearch');

Route::get('asistecia/agregar/{idInforme}','AsisteciaController@create')->name('agregarAsistecia');
Route::post('asistecia/guardar/{idInforme}','AsisteciaController@store')->name('asistecia.guardar');
Route::get('asistencia/searchAsistencia/','AsisteciaController@searchAsistencia');
Route::get('asistencia/asistenciaPaginateSearch/','AsisteciaController@asistenciaPaginateSearch');
Route::get('asistencia/searchMiembros/','AsisteciaController@searchMiembros');
Route::get('asistencia/miembrosPaginateSearch/','AsisteciaController@miembrosPaginateSearch');

Route::resource('celula','CelulaController');
Route::resource('informe','InformeController');
Route::resource('asistencia','AsisteciaController');

/********************************************************|
|--------------------------------------------------------|
|  P A Q U E T E  E S C U E L A S   D E   L I D E R E S  |
|--------------------------------------------------------|
 ********************************************************/
Route::get('ficha/agregar/{idclase}','FichaControlController@create')->name('ficha.agregar');
Route::post('ficha/guardar/{idclase}','FichaControlController@store')->name('ficha.guardar');

Route::get('clase/agregar/{modulo}','ClaseController@create')->name('clase.agregar');
Route::post('clase/guardar/{modulo}','ClaseController@store')->name('clase.guardar');

Route::get('modulo/agregar/{escuela}','ModuloController@create')->name('modulo.agregar');
Route::post('modulo/guardar/{escuela}','ModuloController@store')->name('modulo.guardar');

Route::get('escuela/aprobados/{escuela}', 'EscuelaController@aprobados')->name('escuela.aprobados');
Route::get('escuela/reprobados/{escuela}', 'EscuelaController@reprobados')->name('escuela.reprobados');
Route::resource('escuela/', 'EscuelaController');

Route::resource('boleta', 'BoletaInscripcionController');
Route::resource('ficha', 'FichaControlController');
Route::resource('clase', 'ClaseController');
Route::resource('modulo', 'ModuloController');
Route::resource('escuela', 'EscuelaController');

/************************************************|
|------------------------------------------------|
|         P A Q U E T E  R E U N I O N           |
|------------------------------------------------|
 ************************************************/
Route::get('registro/{reunion}', 'RegistroController@lista')->name('registro.lista');
Route::get('registro/agregar/{reunion}', 'RegistroController@create')->name('registro.creating');
Route::post('registro/guardar/{reunion}', 'RegistroController@store')->name('registro.guardar');
Route::get('registro/editar/{id}/{reunion}', 'RegistroController@edit')->name('registro.editar');

Route::get('reunion/searchReunion/','ReunionController@searchReunion');
Route::get('reunion/reunionPaginateSearch/','ReunionController@reunionPaginateSearch');
Route::resource('registro', 'RegistroController');
Route::resource('reunion', 'ReunionController');