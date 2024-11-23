<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends BaseController
{
	public function authenticate()
	{
		if (! $this->validateData($_POST, [
			'username' => [
				'rules'  => 'required|max_length[20]|min_length[4]',
				'errors' => [
					'required'  =>'Debes elegir un nombre de usuario',
					'min_length'=>'Nombre: se requieren al menos 4 caracteres',
					'max_length'=>'Nombre: se requieren como máximo 20 caracteres',
				],
			],
			'password' => [
				'rules'  => 'required|max_length[20]|min_length[4]',
				'errors' => [
					'required'  =>'Debes elegir una contraseña',
					'min_length'=>'Contraseña: se requieren al menos 4 caracteres',
					'max_length'=>'Contraseña: se requieren como máximo 20 caracteres',
				],
			],
		])) {
			$errors = array('errors' => $this->validator->getErrors());
			return view('account/login', $errors);
		}

		$model = model(UsersModel::class);
		
		$query = $model->where('username', $_POST['username'])->first();
		if(isset($query) && ($query['password'] == $_POST['password'])) {
			session()->set(['userSessionID' => $query['id_users']]);
			session()->set(['userSessionName' => $query['username']]);
			return view('home/index');
		}
		$errors = ['errors' => ['Error, usuario o contraseña incorrecta']];
		return view('account/login', $errors);  
	}

	public function new()
	{
		// Verificar validaciones		
		if (! $this->validateData($_POST, [
			'username' => [
				'rules'  => 'required|max_length[20]|min_length[4]',
				'errors' => [
					'required'  =>'Debes elegir un nombre de usuario',
					'min_length'=>'Nombre: se requieren al menos 4 caracteres',
					'max_length'=>'Nombre: se requieren como máximo 20 caracteres',
				],
			],
			'password' => [
				'rules'  => 'required|max_length[20]|min_length[4]',
				'errors' => [
					'required'  =>'Debes elegir una contraseña',
					'min_length'=>'Contraseña: se requieren al menos 4 caracteres',
					'max_length'=>'Contraseña: se requieren como máximo 20 caracteres',
				],
			],
			'email' => [
				'rules'  => 'required|max_length[40]|valid_email',
				'errors' => [
					'required'  =>'Debes elegir un correo',
					'min_length'=>'Correo: se requieren al menos 4 caracteres',
					'max_length'=>'Correo: se requieren como máximo 40 caracteres',
					'valid_email' => 'Por favor revisa que el correo sea una dirección válida.',
				],
			],
		])){
			$errors = array('errors' => $this->validator->getErrors());
			return view('account/register', $errors);
		}
		
		/* TODO: refactorizar. Crear un query que:
		1. busque si no está el usuario
		2. inserte al usuario
		3. recupere el id con el que insertó al usuario */
		$model = model(UsersModel::class);

		// Validar usuario repetido
		$query = $model->where('username', $_POST['username'])->first();
		$errors = ['errors' => ['Error, usuario duplicado']];
		if(isset($query)) return view('account/register', $errors);
		// Insertar en BD
		$model->insert($_POST); 
		// Obtener id, cargar datos de sesión y cargar vista
		$query = $model->where('username', $_POST['username'])->first();
		session()->set(['userSessionID' => $query['id_users']]);
		session()->set(['userSessionName' => $query['username']]);
		return view('home/index');
	}
}