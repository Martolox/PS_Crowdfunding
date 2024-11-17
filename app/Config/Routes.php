<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'HomeController::index');

$routes->get('/authenticate', 'LogController::authenticate');
$routes->get('/login', 'LogController::login');
$routes->get('/logout', 'LogController::logout');
$routes->get('/register', 'LogController::register');

$routes->get('/test', 'UsersController::test');
$routes->get('/users', 'UsersController::list');
$routes->post('/users/create', 'UsersController::create');


$routes->get('/projects', 'ProjectsController::index');
$routes->get('proyects/detalleProjet/(:num)', 'ProjectsController::detalles/$1');
$routes->get('projects/list', 'ProjectsController::list');
$routes->get('projects/myList', 'ProjectsController::listIProyects');

$routes->post('ProjectsController/save_project', 'ProjectsController::save_project');
$routes->get('ProjectsController/changeStatus/(:num)/(:alpha)', 'ProjectsController::changeStatus/$1/$2');
$routes->get('/projects/filter', 'ProjectController::filtrar');


$routes->get('/investments/eliminarInversion/(:num)', 'InvestmentsController::updateEstado/$1');
$routes->get('/investments/update', 'InvestmentsController::update');
$routes->post('/investments/update', 'InvestmentsController::update');
$routes->get('/investments', 'InvestmentsController::index');
$routes->post('/investments', 'InvestmentsController::index');
$routes->post('investments/create', 'InvestmentsController::create');
$routes->get('investments/create', 'InvestmentsController::create');
$routes->post('/investments/save', 'InvestmentsController::save');
$routes->get('investments/list', 'InvestmentsController::list');
