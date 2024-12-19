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

    /**
     * Obtiene las notificaciones de un usuario específico
     *
     * @param int $userId
     * @return \CodeIgniter\HTTP\Response
     */
    public function getUserNotifications() {
       
         // Verifica si hay una sesión de usuario activa
         if (session('userSessionName') == null) {
            return redirect()->to('account/login');
        }
        // Obtener las notificaciones desde el modelo
       
        $notifications = $this->notificationModel->getNotificationsByUser(session('userSessionID'),5);
        
        // Verificar si hay notificaciones
        if (empty($notifications)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No se encontraron notificaciones para este usuario.'
            ])->setStatusCode(404);
        }
     
        // Responder con las notificaciones en formato JSON
        return $this->response->setJSON([
            'status' => 'success', 
            'count' => count($notifications), // Agregar el conteo total
            'data' => $notifications
        ]);
    }

    /**
     * Crea una nueva notificación
     *
     * @return \CodeIgniter\HTTP\Response
     */
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
