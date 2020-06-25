<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/clients', 'ClienteControlador@index');
Route::middleware('auth:sanctum')->post('/clients', 'ClienteControlador@store');
Route::middleware('auth:sanctum')->put('/clients/edit/{id}', 'ClienteControlador@update');
Route::middleware('auth:sanctum')->post('/clients/{id}', 'ClienteControlador@destroy');
Route::middleware('auth:sanctum')->post('/clients/info', 'ClienteControlador@show');
Route::middleware('auth:sanctum')->post('/clients/import', 'ClienteControlador@ImportExcel');

Route::middleware('auth:sanctum')->post('/home/noclientes', 'HomeController@index');


Route::middleware('auth:sanctum')->get('/loans', 'PrestamoControlador@index');
Route::middleware('auth:sanctum')->post('/loans', 'PrestamoControlador@store');
Route::middleware('auth:sanctum')->get('/loans/names', 'PrestamoControlador@show');
Route::middleware('auth:sanctum')->post('/loans/{id}', 'PrestamoControlador@destroy');

Route::middleware('auth:sanctum')->get('/payments', 'PagoControlador@index');
Route::middleware('auth:sanctum')->get('/payments/table', 'PagoControlador@regresarTable');
Route::middleware('auth:sanctum')->put('/payments/abono/{id}', 'PagoControlador@abonar');
Route::middleware('auth:sanctum')->get('/payments/{id}', 'PagoControlador@show');

Route::middleware('auth:sanctum')->get('/info', 'UsuarioControlador@edit');









