<?php

namespace App\Controllers;
use App\Models\InvestmentsModel;
use App\Models\ProjectsModel;
use App\Models\NotificationModel;

class InvestmentsController extends BaseController
{
    public function index() {
        return redirect()->to(base_url('investments/list'));
    }
   
    public function create()
    {
        if (session('userSessionName') == null) return  view('account/login');
        $investmentData = [
            'id_projects' => $this->request->getPost('id_project'), 
            'id_users' => $this->request->getPost('id_username'),   
            'amount' => $this->request->getPost('amount')              
        ];
        $investmentsModel = new InvestmentsModel();

        $projectsModel = new ProjectsModel();
        $notificationModel = new NotificationModel();

        $result = $investmentsModel->insertInvestment($investmentData);
    
        if ($result) {

            // Obtener información del proyecto
            $project = $projectsModel->getProject($investmentData['id_projects']);

            if ($project) {
                // Crear notificación para el creador del proyecto
                $notificationData = [
                    'id_users' => $project['id_users'], // Usuario creador del proyecto
                    'description' => 'Se ha realizado una nueva inversión de ' . $investmentData['amount'] . ' en tu proyecto "' . $project['name'] . '".'
                ];
                
               $notificationModel->save($notificationData);
            }
            return redirect()->to(base_url('projects/list'))->with('success', 'Inversión realizada exitosamente.');
        } else {
            return redirect()->to(base_url('projects/list'))->with('error', 'No se puede invertir en este proyecto porque está cancelado o finalizado.');
        }
    }
    
    public function update()
    {
        if (session('userSessionName') == null) return  view('account/login');
        $id_inversion = $this->request->getPost('id_inversion');
        $monto_nuevo = $this->request->getPost('monto_nuevo');
        $monto_viejo = $this->request->getPost('monto_viejo');
    
        $investmentsModel = new InvestmentsModel();

        $projectsModel = new ProjectsModel();
        $notificationModel = new NotificationModel();

        
        $result = $investmentsModel->updateMonto($id_inversion, $monto_nuevo, $monto_viejo);
    
        if ($result) {

             // Obtener información de la inversión
            $investment = $investmentsModel->getInvestmentById($id_inversion);

            if ($investment) {
                // Obtener información del proyecto
                $project = $projectsModel->getProject($investment['id_projects']);

                if ($project) {
                    // Crear notificación para el creador del proyecto
                    $notificationData = [
                        'id_users' => $project['id_users'], // Usuario creador del proyecto
                        'description' => 'Se ha actualizado una inversión en tu proyecto "' . $project['name'] . '". Nuevo monto: ' . $monto_nuevo . '.'
                    ];
                    $notificationModel->save($notificationData);
                }
            }
            return redirect()->to(base_url('investments/list'))->with('success', 'Inversión actualizada exitosamente.');
        } else {
            return redirect()->to(base_url('investments/list'))->with('error', 'Error al actualizar la inversión. El nuevo monto debe ser mayor que el anterior.');
        }
    }
    

    public function updateEstado($id_inversion)
    {
        if (session('userSessionName') == null) return  view('account/login');
        $investmentsModel = new InvestmentsModel();

        $projectsModel = new ProjectsModel();
        $notificationModel = new NotificationModel();

        $result = $investmentsModel->eliminarInversion($id_inversion);

        if ($result) {

            // Obtener información de la inversión
            $investment = $investmentsModel->getInvestmentById($id_inversion);

            if ($investment) {
                // Obtener información del proyecto
                $project = $projectsModel->getProject($investment['id_projects']);

                if ($project) {
                    // Crear notificación para el creador del proyecto
                    $notificationData = [
                        'id_users' => $project['id_users'], // Usuario creador del proyecto
                        'description' => 'Se ha cancelado una inversión en tu proyecto "' . $project['name'] . '".'
                    ];
                   
                    $notificationModel->save($notificationData);
                   
                }
            }
            return redirect()->to(base_url('investments/list'))->with('success', 'Inversión cancelada exitosamente.');
        } else {
            return redirect()->to(base_url('investments/list'))->with('error', 'No se puede cancelar la inversión porque el proyecto ha sido finalizado.');
        }
    }
   

    public function list()
    {
        if (session('userSessionName') == null) return  view('account/login');
        $userId = session('userSessionID');
        $investmentsModel = new InvestmentsModel();
        $investments_proyects = $investmentsModel->misInversiones($userId); 
        $data = [
            'investments_proyects' => $investments_proyects
        ];
    
        return view('investments/my_investments', $data);
    }
}