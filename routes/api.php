<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InversionController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'inversion'], function () {
    Route::post('/solicitar', [InversionController::class, 'solicitar'])->name('inversion.solicitar');
    Route::post('/cancelar', [InversionController::class, 'cancelar'])->name('solicitud.cancelar');
});
