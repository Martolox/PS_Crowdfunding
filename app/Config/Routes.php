<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\HomeController;
use App\Controllers\LogController;
use App\Controllers\InvestmentsController;
use App\Controllers\ProjectsController;
use App\Controllers\UsersController;

$routes->get('/', 						[HomeController::class, 'index']);
$routes->get('/test', 'HomeController::test');

/* Login */
$routes->get('/login', 					[LogController::class, 'login']);
$routes->get('/logout', 				[LogController::class, 'logout']);
$routes->get('/register', 				[LogController::class, 'register']);

/* Users */
$routes->post('/users/new', 			[UsersController::class, 'new']);
$routes->post('/users/update', 			[UsersController::class, 'update']);
$routes->post('/authenticate', 			[UsersController::class, 'authenticate']);

/* Projects */
$routes->get('/projects/list', 			[ProjectsController::class, 'list']);
$routes->get('/projects/detail/(:num)', [ProjectsController::class, 'detail/$1']);
$routes->get('/projects/myList', 		[ProjectsController::class, 'listMyProjects']);

$routes->get('/ProjectsController/changeStatus/(:num)/(:alpha)', 'ProjectsController::changeStatus/$1/$2');

$routes->get('/projects/filter/(:any)', 'ProjectsController::filtrar/$1');
$routes->get('/projects/filterMylist/(:any)', 'ProjectsController::filtrarMisProyectos/$1');
$routes->get('/projectsController/final_project/(:num)', 'ProjectsController::final_project/$1');
$routes->get('/projectsController/getProject/(:num)', 'ProjectsController::getProject/$1');
$routes->post('/ProjectsController/save_project', 'ProjectsController::save_project');
$routes->post('/projectsController/cancel_project/(:num)', 'ProjectsController::cancel_project/$1');

/* Investments */
$routes->get('/investments/eliminarInversion/(:num)', 'InvestmentsController::updateEstado/$1');
$routes->get('/investments/update', 'InvestmentsController::update');
$routes->post('/investments/update', 'InvestmentsController::update');
$routes->get('/investments', 'InvestmentsController::index');
$routes->post('/investments', 'InvestmentsController::index');
$routes->post('investments/create', 'InvestmentsController::create');
$routes->get('/investments/create', 'InvestmentsController::create');
$routes->post('/investments/save', 'InvestmentsController::save');
$routes->get('/investments/list', 'InvestmentsController::list');
