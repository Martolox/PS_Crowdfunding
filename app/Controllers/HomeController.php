<?php

namespace App\Controllers;
use App\Models\UsersModel;

class HomeController extends BaseController
{
    public function index(): string {
        return view('home/index');
    }

    public function test(): string {
        return view('home/navbar');
    }
}