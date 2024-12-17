<?php
namespace App\Controllers;

use App\Models\UpdatesModel;
use App\Models\NotificationModel;
use App\Models\InvestmentsModel;
use CodeIgniter\HTTP\ResponseInterface;

class UpdatesController extends BaseController
{
    protected $updatesModel;
    protected $notificationModel;
    protected $investmentsModel;

    public function __construct()
    {
        $this->updatesModel = new UpdatesModel();
        $this->notificationModel = new NotificationModel();
        $this->investmentsModel = new InvestmentsModel();
    }

    // Método para crear una nueva actualización de proyecto
    public function create()
    {
        if (session('userSessionName') == null) {
            return redirect()->to('account/login');
        }

        $data = [
            'version' => $this->request->getPost('version'),
            'description' => $this->request->getPost('description'),
            'id_projects' => $this->request->getPost('id_projects')
        ];

        if (!$this->updatesModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->updatesModel->errors()
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // Obtener los inversores asociados al proyecto
        $id_projects = $data['id_projects'];
        $investors = $this->investmentsModel->where('id_projects', $id_projects)->findAll();

        // Crear notificaciones para cada inversor
        foreach ($investors as $investor) {
            $notificationData = [
                'id_users' => $investor['id_users'],
                'description' => "El proyecto con ID {$id_projects} tiene una nueva actualización: {$data['description']}"
            ];
            $this->notificationModel->save($notificationData);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Actualización del proyecto creada con éxito y notificaciones enviadas a los inversores.'
        ])->setStatusCode(ResponseInterface::HTTP_OK);
    }

    // Método para listar actualizaciones por ID de proyecto
    public function listByProject($id_project)
    {
        if (session('userSessionName') == null) {
            return redirect()->to('account/login');
        }

        $updates = $this->updatesModel->where('id_projects', $id_project)->findAll();

        if (empty($updates)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No se encontraron actualizaciones para este proyecto.'
            ])->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $updates
        ])->setStatusCode(ResponseInterface::HTTP_OK);
    }
}

