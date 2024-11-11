<?php

namespace App\Controllers;
use CodeIgnite\Controller;
use App\Models\ProjectsModel;
use CodeIgniter\I18n\Time;
use DateTime;

class ProjectsController extends BaseController
{
    public function index(): string
    {
       // error_log("Pasé por este punto del código.");
        //error_log(DateTime::createFromFormat('Y-m-d', '2024-12-221')); 
       // $model= new ProjectsModel();
       /* $id = $model->insert([
            "id_users" => "1",
            "name" => "Pepe",
            "category" => "Tecnologia",
            "impact"=> "Alto",
            "budget" => "1",
            "status" =>"ACTIVO",
            "end_date" => date("Y-m-d"),//DateTime::createFromFormat('Y-m-d', '2024-12-21'), 
            "reward_plan" => "0.15"
        ]);*/
       // error_log("Pasé por este otro punto del código.");

       $projectModel = new ProjectsModel();
        
       // Obtener el ID del usuario logueado (supongamos que está almacenado en la sesión)
       $userId = session()->get('user_id');
       
       // Obtener los proyectos del usuario
       $projects = $projectModel->getProjectsByUserId($userId);

       // Pasar los proyectos a la vista
       return view('projects/index', ['projects' => $projects]);


       // return view('projects/index');
    }


      // Guarda o actualiza un proyecto
    public function save_project() {
        $model= new ProjectsModel();

       

        $endDate = $this->request->getPost('end_date');
        
        // Verifica que la fecha esté en el formato adecuado (por ejemplo, 'Y-m-d')
        if (DateTime::createFromFormat('Y-m-d', $endDate) !== false) {
           
            error_log("Pasé por este punto del código.  ".$this->request->getPost('category')."-".$this->request->getPost('impact')."-".$this->request->getPost('budget')."-".$this->request->getPost('status')."-".$endDate."-".$this->request->getPost('reward_plan'));
            $projectData = [
                'id_users'=>'4',
                'name' => $this->request->getPost('name'),
                'category' => $this->request->getPost('category'),
                'impact' => $this->request->getPost('impact'),
                'budget' => $this->request->getPost('budget'),
                'status' => $this->request->getPost('status'),
                'end_date' => $endDate, // El formato es válido, así que lo puedes guardar directamente
                'reward_plan' => $this->request->getPost('reward_plan'),
            ];
            error_log(json_encode($projectData));
           

        } else {
            // Manejar error: el formato de fecha no es válido
            echo "La fecha no tiene el formato correcto.";
        }


       
error_log("llegue lejos");
        $projectId = $this->request->getPost('project_id');
        error_log("id".$this->request->getPost('project_id'));
        if ($projectId) {
            // Actualiza el proyecto existente
            error_log("por update");
            $model->update_project($projectId, $projectData);
        } else {
            error_log("por insert");
            // Inserta un nuevo proyecto
            $model->insert_project($projectData);
        }



        return redirect()->to(base_url('/'));
        //return redirect()->to('/project'); // Ajusta la ruta según tu proyecto
    }


    public function list(): string
    {   
        $model= new ProjectsModel();

        return view('projects/list');
    }



    public function changeStatus($projectId, $newStatus)
{
    $projectModel = new ProjectsModel();

    // Actualiza el estado del proyecto
    $projectModel->update($projectId, ['status' => $newStatus]);

    // Redirige a la página de proyectos
    return redirect()->to(base_url('/'));
}

}