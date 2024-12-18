<?php

namespace App\Controllers;
use App\Models\CommentsModel;

class CommentsController extends BaseController
{
	public function create() {
		if (session('userSessionName') == null) return  view('account/login');
		$errors = $this->validateCommentsForm();
		if (isset($errors)) {
			return redirect()
				->to($_POST['url'])
				->with('error', implode(array_pop($errors)));
		}
		$model = model(CommentsModel::class);
		$data = array('id_projects' => $_POST['id_projects'],
					  'id_users' => session('userSessionID'),
					  'comment' => $_POST['cMessage'],
					  'email' => session('userSessionEmail'));
		$model->insert($data);
		return redirect()->to($_POST['url'])->with('success', 'Mensaje enviado satisfactoriamente');
	}

	private function validateCommentsForm() {
		if (! $this->validateData($_POST, [
			'cMessage' => [
				'rules'  => 'required|max_length[200]|min_length[4]',
				'errors' => [
					'required'  =>'El campo del mensaje no puede quedar vacío.',
					'min_length'=>'Se requieren al menos 4 caracteres en el mensaje.',
					'max_length'=>'Se requieren como máximo 200 caracteres en el mensaje.'
				],
			]
		])) {
			return $errors = array('errors' => $this->validator->getErrors());
		}
	}
}