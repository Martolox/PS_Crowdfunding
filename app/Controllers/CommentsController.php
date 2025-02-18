<?php

namespace App\Controllers;
use App\Models\CommentsModel;
use CodeIgniter\CLI\Console;

class CommentsController extends BaseController
{
	protected $commentsModel;

	public function __construct() {
		$this->commentsModel = new CommentsModel();
	}

	public function create() {
		if (session('userSessionName') == null) return  view('account/login');
		/*
		$errors = $this->validateCommentsForm();
		if (isset($errors)) {
			return redirect()
				->to($_POST['url'])
				->with('error', implode(array_pop($errors)));
		}*/
		$model = model(CommentsModel::class);

		$data = array('id_projects' => $_POST['id_projects'],
					  'id_users' => session('userSessionID'),
					  'comment' => $_POST['cMessage'],
					  'email' => session('userSessionEmail'));
		$model->insert($data);
		return redirect()->to($_POST['url'])->with('success', 'Mensaje enviado satisfactoriamente');
	}

	public function getUserComments() {	   	   
		$comments = $this->commentsModel->getCommentsByUser(session('userSessionID'),5);
		
		// Verificar si hay comments
		if (empty($comments)) {
			return $this->response->setJSON([
				'status' => 'error',
				'message' => 'No se encontraron comentarios para este usuario.'
			])->setStatusCode(404);
		}
	 
		return $this->response->setJSON([
			'status' => 'success', 
			'count' => count($comments),
			'data' => $comments
		]);
	}

	public function listMyNotifications(): string {   
		 // Verifica si hay una sesión de usuario activa
		 if (session('userSessionName') == null) {
			return redirect()->to('account/login');
		}
		// Obtener las notificaciones desde el modelo
	   error_log('estoy aca');
		$notifications = $this->notificationModel->getNotificationsByUser(session('userSessionID'),50);
		
		return view('notifications/my_notifications', ['notifications' => $notifications]);
	}
}