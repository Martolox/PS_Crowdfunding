<?php

namespace App\Controllers;
use App\Models\ProjectsModel;

class HomeController extends BaseController
{
    public function index(): string
    {

        $projectModel = new ProjectsModel();
        
        // Obtener el ID del usuario logueado (supongamos que está almacenado en la sesión)
        //$userId = session()->get('user_id');
        $userId = 4;
        
        // Obtener los proyectos del usuario
        $projects = $projectModel->getProjectsByUserId($userId);

        //$projectsInv = $projectModel->get_published_projects();
        $projectsInv = [];
        // Pasar los proyectos a la vista
       // return view('projects/index', ['projects' => $projects]);

        return view('home/index', ['projects' => $projects, 'projectsInv' => $projectsInv]);
    }
}