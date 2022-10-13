<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::post('/refresh', [UserController::class, 'refresh']);
        Route::get('/data', [UserController::class, 'data']);
    });
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('/showAll', [PostController::class, 'getAllPost']);
    Route::get('/show/{user_id}', [UserController::class, 'get_user_post']);
    Route::post('/createPost', [PostController::class, 'createPost']);
    Route::put('/updatePost/{id}', [PostController::class, 'updatePost']);
    Route::delete('/deletePost/{id}', [PostController::class, 'deletePost']);
});
