<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TaskController;
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

Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class, 'logout']);

Route::middleware(['auth:sanctum'])->group(function () {

     //users
     Route::prefix('/users')->group(function () {
        Route::get('/',[UserController::class, 'index']);
        Route::post('/store',[UserController::class, 'store']);
        Route::get('/edit/{id}',[UserController::class, 'edit']);
        Route::put('/update/{id}',[UserController::class, 'update']);
        Route::delete('/destroy/{id}',[UserController::class, 'destroy']);
    });

     //tasks
     Route::prefix('/tasks')->group(function () {
        Route::get('/',[TaskController::class, 'index']);
        Route::get('/workers',[TaskController::class, 'workers']);
        Route::post('/store',[TaskController::class, 'store']);
        Route::get('/edit/{id}',[TaskController::class, 'edit']);
        Route::put('/update/{id}',[TaskController::class, 'update']);
        Route::put('/status/{id}',[TaskController::class, 'updateStatus']);
        Route::delete('/destroy/{id}',[TaskController::class, 'destroy']);
    });



});
