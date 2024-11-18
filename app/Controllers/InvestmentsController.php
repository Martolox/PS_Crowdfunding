<?php

namespace App\Controllers;
use App\Models\InvestmentsModel;

class InvestmentsController extends BaseController
{
    public function index() {
        return redirect()->to(base_url('investments/list'));
    }
   
    public function create()
    {
        $investmentData = [
            'id_projects' => $this->request->getPost('id_project'), 
            'id_users' => $this->request->getPost('id_username'),   
            'amount' => $this->request->getPost('amount')              
        ];
        $investmentsModel = new InvestmentsModel();
        $result = $investmentsModel->insertInvestment($investmentData);
    
        if ($result) {
            return redirect()->to(base_url('projects/list'))->with('message', 'Inversión realizada exitosamente.');
        } else {
            return redirect()->to(base_url('projects/list'))->with('error', 'No se puede invertir en este proyecto porque está cancelado o finalizado.');
        }
    }
    
    public function update()
    {
        $id_inversion = $this->request->getPost('id_inversion');
        $monto_nuevo = $this->request->getPost('monto_nuevo');
        $monto_viejo = $this->request->getPost('monto_viejo');
    
        $investmentsModel = new InvestmentsModel();
        $result = $investmentsModel->updateMonto($id_inversion, $monto_nuevo, $monto_viejo);
    
        if ($result) {
            return redirect()->to(base_url('investments/list'))->with('message', 'Inversión actualizada exitosamente.');
        } else {
            return redirect()->to(base_url('investments/list'))->with('error', 'Error al actualizar la inversión. El nuevo monto debe ser mayor que el anterior.');
        }
    }
    

    public function updateEstado($id_inversion)
    {
        $investmentsModel = new InvestmentsModel();
        $result = $investmentsModel->eliminarInversion($id_inversion);

        if ($result) {
            return redirect()->to(base_url('investments/list'))->with('message', 'Inversión cancelada exitosamente.');
        } else {
            return redirect()->to(base_url('investments/list'))->with('error', 'No se puede cancelar la inversión porque el proyecto ha sido finalizado.');
        }
    }
   

    public function list()
    {
        //$userId = session()->get('user_id');
        
        $investmentsModel = new InvestmentsModel();
        $investments_proyects = $investmentsModel->misInversiones(1); //userID en lugar de 1
        $data = [
            'investments_proyects' => $investments_proyects
        ];
    
        return view('investments', $data);
    }
}