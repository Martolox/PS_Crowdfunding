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

	public function new()
	{
		helper('form');
		$data = $this->request->getPost(['username', 'password', 'email']);
		
		// Validar campos
		if (! $this->validateData($data, [
			'username' => 'required|max_length[20]|min_length[4]',
			'password' => 'required|max_length[20]|min_length[4]',
			'email' => 'required|max_length[40]|min_length[6]']))
			return redirect()->to('register');

		$post = $this->validator->getValidated();
		$model = model(UsersModel::class);
		
		// Validar usuario repetido
		$query = $model->where('username', $data['username'])->first();
		if(isset($query)) return redirect()->to('register'); //TODO: Pasar mensaje de error
		
		// Insertar, guardar Username en sesión y cargar vista
		$model->insert($data);
		session()->set(['userSessionID' => $query['id']]);
		session()->set(['userSessionName' => $query['username']]);
		return view('template/header')
			. view('template/navbar')
			. view('home/index')
			. view('template/footer');
	}

	private function setValidationRules()
	{
		$validation = \Config\Services::validation();
		$validation->setRules([ // Restricciones
			'username'      =>'required|min_length[4]|max_length[20]',
			'password'      =>'required|max_length[20]|min_length[4]',
			'email'         =>'required|max_length[40]|min_length[6]'
		],[                     // Mensaje
			'username'      => [
				'required'  =>'Se requiere nombre de usuario',
				'min_length'=>'Título: se requieren al menos 4 caracteres',
				'max_length'=>'Título: se requieren como máximo 40 caracteres'
			],
			'password'      => [
				'required'  =>'Se requiere contraseña',
				'min_length'=>'Contraseña: se requieren al menos 4 caracteres',
				'max_length'=>'Contraseña: se requieren como máximo 20 caracteres'
			],
			'email'     => [
				'required'  =>'Se requiere correo',
				'min_length'=>'Correo: se requieren al menos 4 caracteres',
				'max_length'=>'Correo: se requieren como máximo 20 caracteres'
			],
		]);
	}
}