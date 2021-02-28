<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->group(function(){
  Route::PATCH('/profile', [UserController::class, 'updateUserProfile']);
  Route::get('/profile', [UserController::class, 'getUserProfile']);
  Route::DELETE('/profile', [UserController::class, 'deleteUserProfile']);
  Route::get('/find-users', [UserController::class, 'findUsers']);

});

Route::post('/register', [UserController::class, 'register']);
