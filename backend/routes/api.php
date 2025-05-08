<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Api\Auth'], function (Router $router) {
    $router->post('/login', 'AuthController@login')->middleware('guest:sanctum');
    $router->post('/2fa', 'AuthController@confirmTwoFactor')->middleware('guest:sanctum');

    $router->get('/me', 'AuthController@me')->middleware('auth:sanctum');

    $router->post('/logout', 'AuthController@logout')->middleware('auth:sanctum');
});

$router->group(['prefix' => 'tickets', 'namespace' => 'App\Http\Controllers\Api\Ticket', 'middleware' => 'auth:sanctum'], function (Router $router) {
    $router->post('/create', 'MutateController@create');
});

require 'admin_api.php';
