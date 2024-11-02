<?php

namespace App\Controllers;

class ProjectsController extends BaseController
{
    public function index(): string
    {
        return view('projects/index');
    }

    public function list(): string
    {   
        return view('projects/list');
    }
}