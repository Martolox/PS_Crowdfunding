<?php

namespace App\Controllers;
use CodeIgnite\Controller;
use App\Models\ProjectsModel;
use CodeIgniter\I18n\Time;


class ProjectsController extends BaseController
{
    public function index(): string
    {
        error_log("Pasé por este punto del código.");
        //error_log(DateTime::createFromFormat('Y-m-d', '2024-12-221')); 
        $model= new ProjectsModel();
        $id = $model->insert([
            "id_users" => "1",
            "name" => "Pepe",
            "category" => "Tecnologia",
            "impact"=> "Alto",
            "budget" => "1",
            "status" =>"ACTIVO",
            "end_date" => date("Y-m-d"),//DateTime::createFromFormat('Y-m-d', '2024-12-21'), 
            "reward_plan" => "0.15"
        ]);
        error_log("Pasé por este otro punto del código.");
        return view('projects/index');
    }


      // Guarda o actualiza un proyecto
    public function save_project() {
        $model= new ProjectsModel();
        $projectData = [
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'impact' => $this->request->getPost('impact'),
            'budget' => $this->request->getPost('budget'),
            'status' => $this->request->getPost('status'),
            'end_date' => $this->request->getPost('end_date'),
            'reward_plan' => $this->request->getPost('reward_plan'),
        ];

        $projectId = $this->request->getPost('project_id');
        
        if ($projectId) {
            // Actualiza el proyecto existente
            $model->update_project($projectId, $projectData);
        } else {
            // Inserta un nuevo proyecto
            $model->insert_project($projectData);
        }

        return redirect()->to('/project'); // Ajusta la ruta según tu proyecto
    }


    public function list(): string
    {   
        $model= new ProjectsModel();

        return view('projects/list');
    }
}