<?php

namespace App\Controllers;

class ProjectsController extends BaseController
{
    public function index(): string
    {
        return view('projects/index');
    }
}