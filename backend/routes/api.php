<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerencanaanController;

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
//akses public route
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);
route::resource('/perencanaan',PerencanaanController::class)->except(['create','edit']);
//akses route yang sudah login dan memiliki token
Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::post('/logout',[AuthController::class, 'logout']);
});

