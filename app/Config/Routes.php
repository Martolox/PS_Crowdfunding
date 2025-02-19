<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\CommentsController;
use App\Controllers\HomeController;
use App\Controllers\InvestmentsController;
use App\Controllers\LogController;
use App\Controllers\NotificationController;
use App\Controllers\ProjectsController;
use App\Controllers\ScoresController;
use App\Controllers\UsersController;


$routes->get('/', 							[HomeController::class, 'index']);

/* Login */
$routes->get('/login', 						[LogController::class, 'login']);
$routes->get('/logout', 					[LogController::class, 'logout']);
$routes->get('/register', 					[LogController::class, 'register']);

/* Users */
$routes->post('/users/new', 				[UsersController::class, 'new']);
$routes->post('/users/update', 				[UsersController::class, 'update']);
$routes->post('/authenticate', 				[UsersController::class, 'authenticate']);

/* Projects */
$routes->get('/projects/list', 				[ProjectsController::class, 'list']);
$routes->get('/projects/detail/(:num)', 	[ProjectsController::class, 'detail/$1']);
$routes->get('/projects/myList', 			[ProjectsController::class, 'listMyProjects']);

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
$routes->get('/investments', 'InvestmentsController::index');
$routes->get('/investments/create', 'InvestmentsController::create');
$routes->get('/investments/list', 'InvestmentsController::list');
$routes->post('/investments/update', 'InvestmentsController::update');
$routes->post('/investments', 'InvestmentsController::index');
$routes->post('/investments/create', 'InvestmentsController::create');
$routes->post('/investments/save', 'InvestmentsController::save');
$routes->get('/investments/detail/(:num)', 'InvestmentsController::detail/$1'); 

/* Scores */
$routes->post('/scores/new', 					[ScoresController::class, 'new']);

/* Comments */
$routes->post('/comments/create', 				[CommentsController::class, 'create']);
$routes->get('/comments/getUserComments', 		[CommentsController::class, 'getUserComments']);
$routes->get('myComments', 						[CommentsController::class, 'listMyComments']);

/* Notifications */
$routes->post('create', 'NotificationController::createNotification');
$routes->get('notifications/getUserNotifications', 'NotificationController::getUserNotifications');
$routes->get('myNotifications', 				[NotificationController::class, 'listMyNotifications']);
	  
$routes->group('updatesController', ['namespace' => 'App\Controllers'], function ($routes) {
	// Ruta para crear una nueva actualización
	$routes->post('create', 'UpdatesController::create');
	// Ruta para listar actualizaciones por ID de proyecto
	$routes->get('listByProject/(:num)', 'UpdatesController::listByProject/$1');
});