<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;
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

//ApiController
Route::post('/create',[ApiController::class,"create"]);
Route::post('/check',[ApiController::class,"check"]);
Route::delete('/remove/{id}',[ApiController::class,"remove"]);
Route::put('/update',[ApiController::class,"update"]);
Route::get('/display',[ApiController::class,"display"]);






// UserController
Route::post('/register',[UserController::class,"register"]);
Route::post('/login',[UserController::class,"login"]);
Route::delete('/delete/{id}',[UserController::class,"delete"]);
Route::get('/display',[UserController::class,"display"]);
