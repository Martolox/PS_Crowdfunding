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
        $investmentsModel->insert($investmentData);
        return redirect()->to(base_url('investments/list'));
    }

   public function update()
    {
        $id_inversion = $this->request->getPost("id_inversion");
        $monto_nuevo = $this->request->getPost("monto_nuevo");
        $monto_viejo = $this->request->getPost("monto_viejo");

        $investmentsModel = new InvestmentsModel();
        $investmentsModel->updateMonto($id_inversion,$monto_nuevo,$monto_viejo);
        return redirect()->to(base_url('investments/list'));
    }

    public function updateEstado($id_inversion)
    {
        $investmentsModel = new InvestmentsModel();
        $investmentsModel->eliminarInversion($id_inversion);
        return redirect()->to(base_url('investments/list'));
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