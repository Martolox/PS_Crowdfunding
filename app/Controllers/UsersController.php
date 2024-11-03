<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends BaseController
{
    public function index(): string
    {
        return view('register/index');
    }

    public function create()
    {
        $data = $this->request->getPost(['username', 'password', 'email']);
        // $usersModel = new UsersModel();
        // $users = $usersModel->insert($data);

        // agregar un alert, usuario registrado

        return redirect()->to(base_url('test'));
    }

    public function list()
    {
        $userModel = new UsersModel();
        $users = $userModel->findAll();
        $data = ['num' => '1234'];

        return view('/account/users-list', $data);
    }

    public function test()
    {
        return view('test');

    }
}