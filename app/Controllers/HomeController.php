<?php

namespace App\Controllers;
use App\Models\UsersModel;

class HomeController extends BaseController
{
    public function index(): string {
        return view('home/index');
    }

    public function test(): string {
        if(session('userSessionName') !== null) {
            //dd('Inicio de sesión', session('userSessionName'));
        }
        return view('home/navbar');
    }
}