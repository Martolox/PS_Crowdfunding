<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\HomeController;
use App\Controllers\LogController;
use App\Controllers\InvestmentsController;
use App\Controllers\ProjectsController;
use App\Controllers\UsersController;
use App\Controllers\NotificationController;

$routes->get('/', 						[HomeController::class, 'index']);

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

/* Comments */


/* Notifications */

// $routes->get('user/(:num)', 'NotificationController::getUserNotifications/$1'); // Obtener notificaciones de un usuario
 $routes->post('create', 'NotificationController::createNotification');   // Crear una nueva notificación
 $routes->get('notifications/getUserNotifications', 'NotificationController::getUserNotifications');
	  
 $routes->group('updatesController', ['namespace' => 'App\Controllers'], function ($routes) {
	// Ruta para crear una nueva actualización
	$routes->post('create', 'UpdatesController::create');
	
	// Ruta para listar actualizaciones por ID de proyecto
	$routes->get('listByProject/(:num)', 'UpdatesController::listByProject/$1');
});