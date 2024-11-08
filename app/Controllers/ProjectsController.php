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

    public function list(): string
    {   
        $model= new ProjectsModel();

        return view('projects/list');
    }
}