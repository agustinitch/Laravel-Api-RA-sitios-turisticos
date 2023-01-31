<?php

use App\Http\Controllers\Api\ApiProductoController;
use App\Http\Controllers\DownloadController;
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

//ruta para dar acceso a todas las rutas
Route::apiResource('modelos', ApiProductoController::class);

//ruta de descarga de imagen
Route::get('descargaIMG/{id}', [DownloadController::class, 'downloadimage']);

//ruta de descarga de modelo
Route::get('descargaMODELO/{id}', [DownloadController::class, 'downloadmodelo']);