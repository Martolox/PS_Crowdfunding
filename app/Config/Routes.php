<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'HomeController::index');

$routes->get('/authenticate', 'LogController::authenticate');
$routes->get('/login', 'LogController::login');
$routes->get('/logout', 'LogController::logout');
$routes->get('/register', 'LogController::register');

$routes->get('/test', 'UsersController::test');

$routes->get('/projects', 'ProjectsController::index');
$routes->get('/projects/index', 'ProjectsController::index');


$routes->get('/users', 'UsersController::list');


$routes->post('/users/create', 'UsersController::create');
