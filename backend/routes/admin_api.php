<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Api\Admin', 'middleware' => 'auth:sanctum'], function (Router $router) {
    $router->group(['prefix' => 'categories', 'namespace' => 'Category'], function (Router $router) {
        $router->get('/', 'IndexController');
        $router->get('/{categoryId}', 'ShowController');
        $router->post('/create', 'CreateController');
        $router->patch('/{categoryId}/update', 'UpdateController');
        $router->delete('/{categoryId}/delete', 'DeleteController');
    });

    $router->group(['prefix' => 'statuses', 'namespace' => 'Status'], function (Router $router) {
        $router->get('/', 'IndexController');
        $router->get('/{statusId}', 'ShowController');
        $router->post('/create', 'CreateController');
        $router->patch('/{statusId}/update', 'UpdateController');
        $router->delete('/{statusId}/delete', 'DeleteController');
    });

    $router->group(['prefix' => 'roles', 'namespace' => 'Role'], function (Router $router) {
        $router->get('/', 'IndexController');
        $router->get('/{roleId}', 'ShowController');
        $router->post('/create', 'CreateController');
        $router->patch('/{roleId}/update', 'UpdateController');
        $router->delete('/{roleId}/delete', 'DeleteController');
    });
});
