<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --ROUTES--

    // -> LOGIN
    $routes->get('/', 'AuthController::index');
    $routes->post('/auth', 'UserController::verifyUser');

    // -> CLIENTS
    $routes->get('/clients','ClientsController::index');
    $routes->post('/clients/add','ClientsController::insert');
    $routes->get('/clients/getall','ClientsController::getAllClients');

    // -> USERS
    $routes->post('/users/add','UsersController::createUser');

