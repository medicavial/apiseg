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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware'=>'cors'], function ()
{
  Route::get('prueba', function () {
      return 'Hello World';
  });
});

Route::get('breweries', ['middleware' => 'cors', function()
{
    return \Response::json(\App\Brewery::with('beers', 'geocode')->paginate(10), 200);
}]);

Route::post('login', array('uses' => 'LoginController@getUsuarios'));

Route::group(array('prefix' => 'api', 'middleware' => 'cors'), function()
{
  Route::post('login', array('uses' => 'LoginController@getUsuarios'));


	Route::group(array('prefix' => 'busqueda', 'middleware' => 'cors'), function()
	{
		Route::post('login', array('uses' => 'BusquedasController@login'));
		Route::get('busquedaAutorizaciones/{fechaIni}/{fechaFin}', array('uses' => 'BusquedasController@getAutorizaciones'));
    Route::get('busquedaUnidades', array('uses' => 'BusquedasController@getUnidades'));
    Route::get('busquedaAutMV/{fechaIni}/{fechaFin}', array('uses' => 'BusquedasController@getAutMV'));
    Route::get('busquedaAutZima', array('uses' => 'BusquedasController@getAutZima'));
    Route::get('buscaDetalleAutorizacion/{aut}/{tipo}', array('uses' => 'BusquedasController@DetalleAutorizacion'));
    Route::get('cliente', array('uses' => 'BusquedasController@cliente'));   
    Route::get('riesgo', array('uses' => 'BusquedasController@riesgo'));
    Route::get('posicion', array('uses' => 'BusquedasController@posicion'));
    Route::get('buscatipoDifusion', array('uses' => 'BusquedasController@buscatipoDifusion'));
    Route::get('listadoOportunidades', array('uses' => 'BusquedasController@listadoOportunidades'));
    Route::post('buscaOportunidades', array('uses' => 'BusquedasController@buscaOportunidades'));
    Route::post('detalleOportunidad/{folio}', array('uses' => 'BusquedasController@detalleOportunidad'));
    Route::post('cerrarAP/{folio}', array('uses' => 'BusquedasController@cerrarAP'));


	});

  Route::group(array('prefix' => 'proceso', 'middleware' => 'cors'), function()
  {
    Route::post('insertaCita', array('uses' => 'ProcesoController@insertCita'));    
    Route::post('subirDocumentos/{unidad}/{fecha}', array('uses' => 'ProcesoController@subirDocumentos'));    
    Route::group(array('prefix' => 'Oportunidades', 'middleware' => 'cors'), function()
  {

    Route::post('insertaOportunidad', array('uses' => 'RegistroOportunidadesController@insertaOportunidad'));

  });

});
