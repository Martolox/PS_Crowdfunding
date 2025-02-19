<?php

namespace App\Controllers;
use CodeIgnite\Controller;
use App\Models\ProjectsModel;
use App\Models\CommentsModel;
use App\Models\InvestmentsModel;
use App\Models\NotificationModel;
use App\Models\ScoresModel;
use App\Models\UpdatesModel;
use App\Models\UsersModel;
use CodeIgniter\I18n\Time;
use DateTime;

class ProjectsController extends BaseController
{
	public function save_project() {
		if (session('userSessionName') == null) return  view('account/login');
		$model = new ProjectsModel();
		$endDate = $this->request->getPost('end_date');

		// Verifica que la fecha esté en el formato adecuado (por ejemplo, 'Y-m-d')
		if (DateTime::createFromFormat('Y-m-d', $endDate) !== false) {

			// Cargar el servicio para manejar archivos
			$file = $this->request->getFile('project_image');
			$isFile = ($file && 
						$file->isValid() && 
						!$file->hasMoved() && 
						in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif']) && 
						$file->getSize() <= 2048 * 1024 // 2 MB
						);
			$projectId = $this->request->getPost('project_id');
			//SI VIENE PROJECTID, ESTA EDITANDO PONGO EL STATUS QUE VIENE, SINO EL INICIAL
			if ($projectId){
				$status= $this->request->getPost('status');
			}else{
				$status='EN PROCESO';
			}
			//si viene $projectId estoy editando, no es obligatorio el archivo
			if ($projectId  || $isFile  ) {
				
				if ($isFile ){
						// Ruta relativa dentro de tu proyecto donde guardarás el archivo
						$uploadPath =  ROOTPATH . 'public/uploads/';
						
						// Crear la carpeta si no existe
						if (!is_dir($uploadPath)) {
							mkdir($uploadPath, 0755, true);
						}

						// Generar un nombre único para evitar colisiones
						$newName = $file->getRandomName();
						
						// Mover el archivo a la carpeta
						$file->move($uploadPath, $newName);
						
						// Guardar la ruta del archivo en la base de datos o donde corresponda
						$filePath = '/uploads/' . $newName;
				
				
						$projectData = [
							'id_users' => session('userSessionID'),
							'name' => $this->request->getPost('name'),
							'category' => $this->request->getPost('category'),
							'impact' => $this->request->getPost('impact'),
							'budget' => $this->request->getPost('budget'),
							'status' => $status,
							'end_date' => $endDate, // El formato es válido, así que lo puedes guardar directamente
							'reward_plan' => $this->request->getPost('reward_plan'),
							'img_name' => $filePath,
						];
				 }else{
					$projectData = [
						'id_users' => session('userSessionID'),
						'name' => $this->request->getPost('name'),
						'category' => $this->request->getPost('category'),
						'impact' => $this->request->getPost('impact'),
						'budget' => $this->request->getPost('budget'),
						'status' => $status,
						'end_date' => $endDate, // El formato es válido, así que lo puedes guardar directamente
						'reward_plan' => $this->request->getPost('reward_plan')
					];

				 }
				
			   
				if ($projectId) {
				   // error_log('esto quiero guardar'.$projectData);
					// Actualiza el proyecto existente
					$result = $model->update_project($projectId, $projectData);
					if ($result) {
						return redirect()->to('projects/myList')->with('success', 'Proyecto actualizado exitosamente.');
					} else {
						return redirect()->to('projects/myList')->with('error', 'Error al actualizar el proyecto.');
					}
				} else {
					// Inserta un nuevo proyecto
					$result = $model->insert_project($projectData);
					if ($result) {
						return redirect()->to('projects/myList')->with('success', 'Proyecto creado exitosamente.');
					} else {
						return redirect()->to('projects/myList')->with('error', 'Error al crear el proyecto.');
					}
				}
			} else {
				return redirect()->to('projects/myList')->with('error', 'No se pudo subir el archivo.');
			}
		} else {
			// Manejar error: el formato de fecha no es válido
			return redirect()->to('projects/myList')->with('error', 'La fecha no tiene el formato correcto.');
		}
	}

	public function list(): string {
		if (session('userSessionName') == null) return  view('account/login'); 
		$projectModel = new ProjectsModel();
		$projects = $projectModel->getProjectsNotLogged(session('userSessionID'));
		return view('projects/projects', ['projects' => $projects]);
	}

	public function listMyProjects(): string {   
		if (session('userSessionID') == null) return  view('account/login');
		$projectModel = new ProjectsModel();
		$projects = $projectModel->getProjectsByUserId(session('userSessionID'));
		return view('projects/my_projects', ['projects' => $projects]);
	}

	public function detail($id): string {   
		if (session('userSessionName') == null) return  view('account/login');
		// Obtener datos del proyecto
		$projectModel = new ProjectsModel();
		$project = $projectModel->getProjectWithInvestmentTotal($id);
		if (!$project) {
			return redirect()->to(base_url('/'));
		}
		// Obtener datos de actualizaciones
		$updatesModel = new UpdatesModel();
		$updates = $updatesModel->where('id_projects', $id)->orderBy('version', 'ASC')->findAll();
		// Obtener datos del puntaje del proyecto
		$scoresModel = new ScoresModel();
		$scores = $scoresModel->where('id_projects', $id)->findAll();
		// Ocultar estrellas si usuario ya votó
		$hideStars = false;
		$scoreCount = 0;
		$scoreRate = 0;
		foreach ($scores as $s) {
			$scoreCount++;
			$scoreRate += $s['score'];
			if ($s['id_users'] == session('userSessionID')) $hideStars = true;
		}
		if ($scoreCount == 0) {
			$scoreRate = '';
		} else {
			$scoreRate = number_format(($scoreRate/$scoreCount), 2);
		}

		$data = ['project' => $project,
				 'updates' => $updates,
				 'comments' => $this->addCommentData($id),
				 'hideStars' => $hideStars,
				 'scoreCount' => $scoreCount,
				 'scoreRate' => $scoreRate];
		$data['project']['show_form'] = false;

		if ($this->is_investor($id)) {
			$data['project']['show_form'] = true;
		}
		return view('projects/project_details',  $data);
	}

	public function changeStatus($projectId, $newStatus) {
		if (session('userSessionName') == null) return  view('account/login');
		$projectModel = new ProjectsModel();
		$message = $projectModel->updateProjet($projectId, $newStatus);
	
		if ($message) {
			return redirect()->to('projects/myList')->with('success', $message);
		} else {
			return redirect()->to('projects/myList')->with('error', 'Error al actualizar el estado del proyecto.');
		}
	}
	
	public function cancel_project($projectId) {
		if (session('userSessionName') == null) return  view('account/login');
		$projectModel = new ProjectsModel();
		//agregado para enviar las notificaciones
		$investmentsModel = new InvestmentsModel();
		$notificationModel = new NotificationModel();

		$success = $projectModel->cancelProject($projectId);  
		
		if ($success) {

			// Obtener los usuarios inversores asociados al proyecto
			$investorIds = $investmentsModel->getUsersByProjectId($projectId);

			// Enviar una notificación a cada inversor
			foreach ($investorIds as $investorId) {
				$notificationModel->save([
					'id_users' => $investorId,
					'description' => "El proyecto con ID $projectId ha sido cancelado."
				]);
			}

			return redirect()->to('projects/myList')->with('success', 'El proyecto y sus inversiones fueron cancelados.');
		} else {
			return redirect()->to('projects/myList')->with('error', 'Hubo un error al cancelar el proyecto.');
		}    
	}

	public function final_project($id_project) {
		if (session('userSessionName') == null) return  view('account/login');
		$projectModel = new ProjectsModel();

		//agregado para enviar las notificaciones
		$investmentsModel = new InvestmentsModel();
		$notificationModel = new NotificationModel();


		$project = $projectModel->getProject($id_project);
		if ($project === null) {
			return redirect()->to('projects/myList')->with('error', 'El proyecto no existe.');
		}
		
		$endDate = $project['end_date'];
		 
			if (strtotime($endDate) > strtotime(date('Y-m-d'))) {
				// Si la fecha no es válida, redirigir con error
				return redirect()->to('projects/myList')->with('error', 'No se puede finalizar un proyecto antes de su fecha de finalización.');
			}

		$success = $projectModel->finalProject($id_project);

		if ($success) {
			// Obtener los usuarios inversores asociados al proyecto
			$investorIds = $investmentsModel->getUsersByProjectId($id_project);

			// Enviar una notificación a cada inversor
			foreach ($investorIds as $investorId) {
				$notificationModel->save([
					'id_users' => $investorId,
					'description' => "El proyecto con ID $id_project ha sido Finalizado."
				]);
			}
			return redirect()->to('projects/myList')->with('success', 'El proyecto y sus inversiones fueron Finalizados.');
		} else {
			return redirect()->to('projects/myList')->with('error', 'Hubo un error al Finalizar el proyecto.');
		}    
	}

	public function filtrar($text): string {
		if (session('userSessionName') == null) return  view('account/login');
		$projectModel = new ProjectsModel();
		$projects = $projectModel->filtrarProjets($text);
		return view('projects/proyects', ['projects' => $projects]);
	}

	public function filtrarMisProyectos($text): string {
		if (session('userSessionName') == null) return  view('account/login');
		$projectModel = new ProjectsModel();
		$projects = $projectModel->filtrarIProjets($text);
		return view('projects/my_projects', ['projects' => $projects]);
	}

	public function getProject($id) {
		if (session('userSessionName') == null) return  view('account/login');
		error_log("entre al get");
		$projectModel = new ProjectsModel();
		$project = $projectModel->find($id);
		error_log("traje el project - " .json_encode($project));
		if ($project) {
			return $this->response->setJSON($project);
		}
		return $this->response->setJSON(['error' => 'Proyecto no encontrado.'], 404);
	}

	private function is_investor($id_project) : bool {
		$investmentsModel = new InvestmentsModel();
		$investorIds = $investmentsModel->getUsersByProjectId($id_project);
		if (in_array(session('userSessionID'), $investorIds)) {
			return true;
		}
		return false;
	}

	private function addCommentData($id): array {
		$commentModel = new CommentsModel();
		$comments = $commentModel->getCommentsByProjectId($id);
		$userModel = new UsersModel();
		$users = $userModel->getUsers();
		$commentList = [];
		foreach ($comments as $c) {
			foreach ($users as $u) {
				if ($c['id_users'] == $u['id_users']) {
					$comm 				= $c;
					$comm['username'] 	= $u['username'];
					$comm['img_name'] 	= $u['img_name'];
					$comm['email'] 		= $u['email'];
					$comm['date']		= $c['comment_date'];
					$commentList[] 		= $comm;
					break;
				}
			}
		}
		return $commentList;
	}
}