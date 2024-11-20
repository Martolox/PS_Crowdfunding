<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends BaseController
{
    public function authenticate()
    {
        helper('form');
        $data = $this->request->getPost(['username', 'password']);

        if (! $this->validateData($data, [
            'username' => 'required|min_length[4]|max_length[20]',
            'password' => 'required|min_length[4]|max_length[20]']))
            return redirect()->to('login');

        $post = $this->validator->getValidated();
        $model = model(UsersModel::class);
        
        $query = $model->where('username', $data['username'])->first();
        if(isset($query) && ($query['password'] == $data['password'])) {
            session()->set(['userSessionID' => $query['id_users']]);
            session()->set(['userSessionName' => $query['username']]);
            return view('home/index');
        }
        return view('account/login');  //TODO: Pasar mensaje de error     
    }

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