<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;

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

Route::group(['middleware'=>('auth:sanctum')],function () {
    Route::group(['middleware'=>('is_admin')],function(){
        
    });
    Route::group(['middleware'=>('is_manager')],function(){
    });
    Route::group(['middleware'=>('is_engineer')],function(){
    });
    Route::get('projects',[ProjectController::class,'index']);
    Route::post('projects',[ProjectController::class,'store']);
    Route::put('projects/{id}',[ProjectController::class,'update']);
    Route::delete('projects/{id}',[ProjectController::class,'delete']);

    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
     Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

