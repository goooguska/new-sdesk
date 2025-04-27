<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** @var Router $router */
$router->group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Api\Auth'], function (Router $router) {
    $router->post('/login', 'AuthController@login')->middleware('guest');
});
