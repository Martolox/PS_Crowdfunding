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
        return view('projects/proyects');
    }

    public function save_project()
    {
        $model = new ProjectsModel();
        $endDate = $this->request->getPost('end_date');

        // Verifica que la fecha esté en el formato adecuado (por ejemplo, 'Y-m-d')
        if (DateTime::createFromFormat('Y-m-d', $endDate) !== false) {

            $projectData = [
                'id_users' => '1', //session()->get('user_id');
                'name' => $this->request->getPost('name'),
                'category' => $this->request->getPost('category'),
                'impact' => $this->request->getPost('impact'),
                'budget' => $this->request->getPost('budget'),
                'status' => $this->request->getPost('status'),
                'end_date' => $endDate, // El formato es válido, así que lo puedes guardar directamente
                'reward_plan' => $this->request->getPost('reward_plan'),
            ];

            $projectId = $this->request->getPost('project_id');
            if ($projectId) {
                // Actualiza el proyecto existente
                $result = $model->update_project($projectId, $projectData);
                if ($result) {
                    return redirect()->to('projects/myList')->with('message', 'Proyecto actualizado exitosamente.');
                } else {
                    return redirect()->to('projects/myList')->with('error', 'Error al actualizar el proyecto.');
                }
            } else {
                // Inserta un nuevo proyecto
                $result = $model->insert_project($projectData);
                if ($result) {
                    return redirect()->to('projects/myList')->with('message', 'Proyecto creado exitosamente.');
                } else {
                    return redirect()->to('projects/myList')->with('error', 'Error al crear el proyecto.');
                }
            }
        } else {
            // Manejar error: el formato de fecha no es válido
            return redirect()->to('projects/myList')->with('error', 'La fecha no tiene el formato correcto.');
        }
    }

    public function list(): string
    {   
        $projectModel = new ProjectsModel();
        
        // Obtener los proyectos del usuario
        $projects = $projectModel->getProjects();
 
        // Pasar los proyectos a la vista
        return view('projects/proyects', ['projects' => $projects]);
    }

    public function detalles($id): string
    {   
        // Cargar los detalles del proyecto desde la base de datos
        $projectModel = new ProjectsModel();
        $project = $projectModel->getProjectWithInvestmentTotal($id);

        if (!$project) {
            return redirect()->to(base_url('/')); // Redirigir si no se encuentra el proyecto
        }
        return view('projects/detalleProjet', ['project' => $project]);
    }

    public function listIProyects(): string
    {   
        $projectModel = new ProjectsModel();
        
        // Obtener el ID del usuario logueado (supongamos que está almacenado en la sesión)
        $userId = session()->get('user_id');
        
        // Obtener los proyectos del usuario
        $projects = $projectModel->getProjectsByUserId($userId);
 
        // Pasar los proyectos a la vista
        return view('projects/misProyects', ['projects' => $projects]);
    }


    public function changeStatus($projectId, $newStatus)
    {
        $projectModel = new ProjectsModel();
    
        // Actualiza el estado del proyecto
        $message = $projectModel->updateProjet($projectId, $newStatus);
    
        if ($message) {
            return redirect()->to('projects/myList')->with('message', $message);
        } else {
            return redirect()->to('projects/myList')->with('error', 'Error al actualizar el estado del proyecto.');
        }
    }
    

public function filtrar($text): string
{
    $projectModel = new ProjectsModel();
    $projects = $projectModel->filtrarProjets($text);
    return view('projects/proyects', ['projects' => $projects]);
}

public function filtrarMisProyectos($text): string
{
    $projectModel = new ProjectsModel();
    $projects = $projectModel->filtrarIProjets($text);
    return view('projects/misProyects', ['projects' => $projects]);
}

}