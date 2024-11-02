<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends BaseController
{
    public function index(): string
    {
        return view('register/index');
    }

    public function list()
    {
        $userModel = new UsersModel();
        $users = $userModel->findAll();
        $data = ['num' => '1234'];

        return view('/account/users-list', $data);
    }
}