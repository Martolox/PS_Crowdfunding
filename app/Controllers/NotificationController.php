<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use CodeIgniter\CLI\Console;

class NotificationController extends BaseController
{
	protected $notificationModel;

	public function __construct() {
		$this->notificationModel = new NotificationModel();
	}

	public function getUserNotifications() {	   	   
		$notifications = $this->notificationModel->getNotificationsByUser(session('userSessionID'),5);
		
		// Verificar si hay notificaciones
		if (empty($notifications)) {
			return $this->response->setJSON([
				'status' => 'error',
				'message' => 'No se encontraron notificaciones para este usuario.'
			])->setStatusCode(404);
		}
	 
		return $this->response->setJSON([
			'status' => 'success', 
			'count' => count($notifications),
			'data' => $notifications
		]);
	}

	public function createNotification() {
		// Obtener los datos de la solicitud POST
		$data = $this->request->getPost();
		error_log('entro aca');
		// Validar los datos de entrada
		$validationRules = [
			'id_users' => 'required|is_natural_no_zero',
			'description' => 'required|string|max_length[65535]'
		];

		if (!$this->validate($validationRules)) {
			return $this->response->setJSON([
				'status' => 'error',
				'message' => $this->validator->getErrors()
			])->setStatusCode(400);
		}

		// Insertar la notificación en la base de datos
		$this->notificationModel->save([
			'id_users' => $data['id_users'],
			'description' => $data['description'],
		]);

		return $this->response->setJSON([
			'status' => 'success',
			'message' => 'Notificación creada con éxito.'
		])->setStatusCode(201);
	}
	
	public function listMyNotifications(): string {   
		// Obtener las notificaciones desde el modelo
	   	error_log('estoy aca');
		$notifications = $this->notificationModel->getNotificationsByUser(session('userSessionID'),50);
		
		return view('notifications/my_notifications', ['notifications' => $notifications]);
	}
}
