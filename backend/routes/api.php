<?php

use Illuminate\Routing\Router;

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

/** @var Router $router */
$router->group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Api\Auth'], function (Router $router) {
    $router->post('/login', 'AuthController@login')->middleware('guest:sanctum');
    $router->post('/2fa', 'AuthController@confirmTwoFactor')->middleware('guest:sanctum');

    $router->get('/me', 'AuthController@me')->middleware('auth:sanctum');

    $router->post('/logout', 'AuthController@logout')->middleware('auth:sanctum');
});


