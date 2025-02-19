<?php

namespace App\Controllers;

use App\Models\ScoresModel;

class ScoresController extends BaseController
{
	public function new() {
		$model = model(ScoresModel::class);
		
		$query = $model->where('id_users', $_POST['id_user'])->first();
		// Si el usuario no había puntuado antes el proyecto, subir el nuevo puntaje a BD
		if(is_null($query)) {
			$score = [
						'id_projects' => $_POST['id_project'],
						'id_users' => $_POST['id_user'],
						'score' => $_POST['rate']
					];
			$model->insert($score);
		}
		return redirect()->to('/projects/detail/'.$_POST['id_project']);
	}
}