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
			session()->set(['userSessionEmail' => $query['email']]);
			session()->set(['userSessionProfile' => $query['img_name']]);
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
		session()->set(['userSessionEmail' => $query['email']]);
		session()->set(['userSessionProfile' => 'profile.png']);

		// La imagen placeholder se llama profile. Debe estar en public/uploads.
		session()->set(['userSessionProfile' => 'profile']); 
		return view('home/index');
	}

	public function update()
	{
		// Verificar validaciones de username
		if (($_POST['username'] !== '') && ($_POST['username'] !== session('userSessionName'))) {
			if (! $this->validateData($_POST, [
				'username' => [
					'rules'  => 'max_length[20]|min_length[4]',
					'errors' => [
						'min_length'=>'Nombre: se requieren al menos 4 caracteres',
						'max_length'=>'Nombre: se requieren como máximo 20 caracteres',
					],
				],
			])){
				$errors = array('errors' => $this->validator->getErrors());
				return redirect()->to('/')->with('error', 'Nombre de usuario inválido');
			}
		}
		// Verificar validaciones de email
		if(($_POST['email'] !== '') && ($_POST['email'] !== session('userSessionEmail'))) {
			if (! $this->validateData($_POST, [
				'email' => [
					'rules'  => 'max_length[40]|min_length[4]',
					'errors' => [
						'min_length'=>'Correo: se requieren al menos 4 caracteres',
						'max_length'=>'Correo: se requieren como máximo 40 caracteres',
					],
				],
			])){
				$errors = array('errors' => $this->validator->getErrors());
				return redirect()->to('/')->with('error', 'Correo inválido');
			}
		}

		////////////////////////////////////////////////////////////////////////

		// Verificar carga de imagen
		$file = $this->request->getFile('img_name');

		if ($file && 
			$file->isValid() && 
			!$file->hasMoved() && 
			in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif']) && 
			$file->getSize() <= 2048 * 1024
		) {
			$uploadPath =  ROOTPATH . '/public/uploads/';
			error_log("estoy creando el path - ".$uploadPath);
			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0755, true);
		}

		$newName = $file->getRandomName();
		$file->move($uploadPath, $newName);
		$filePath = '/uploads/' . $newName;


		////////////////////////////////////////////////////////////////////////

		$model = model(UsersModel::class);
		// Validar usuario repetido
		$query = $model->where('username', $_POST['username'])->first();
		$errors = ['errors' => ['Error, usuario duplicado']];
		if(isset($query)) return redirect()->to('/')->with('error', 'Usuario duplicado');
		
		// Preparar datos
		$data = ['id_users' => session('userSessionID')];
		if($_POST['username'] !== '')
			$data['username'] = $_POST['username'];
		else
			$data['username'] = session('userSessionName');
        if($_POST['email'] !== '')
			$data['email'] = $_POST['email'];
		else
			$data['email'] = session('userSessionEmail');
		if($_POST['img_name'] !== '')
			$data['img_name'] = $_POST['img_name'];
		else
			$data['img_name'] = session('userSessionProfile');
        // Actualizar en BD
		$model->update(session('userSessionID'),$data); 

		// Actualizar variables de sesión
		session()->set(['userSessionName' => $data['username']]);
		session()->set(['userSessionEmail' => $data['email']]);
		session()->set(['userSessionEmail' => $data['email']]);

		// La imagen placeholder se llama 'profile'. Debe estar en public/uploads.
		return redirect()->to('/')->with('success', 'Usuario actualizado exitosamente.');
	}
	}
}