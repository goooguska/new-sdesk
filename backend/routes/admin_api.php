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

    $router->group(['prefix' => 'users', 'namespace' => 'User'], function (Router $router) {
        $router->get('/', 'IndexController');
        $router->get('/{userId}', 'ShowController');
        $router->post('/create', 'CreateController');
        $router->patch('/{userId}/update', 'UpdateController');
        $router->delete('/{userId}/delete', 'DeleteController');
    });

    $router->group(['prefix' => 'tickets', 'namespace' => 'Ticket'], function (Router $router) {
        $router->get('/', 'IndexController');
        $router->get('/{ticketId}', 'ShowController');
        $router->post('/create', 'CreateController');
        $router->patch('/{ticketId}/update', 'UpdateController');
        $router->delete('/{ticketId}/delete', 'DeleteController');
    });
});
