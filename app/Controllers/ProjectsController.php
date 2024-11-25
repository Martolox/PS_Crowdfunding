<?php

namespace App\Controllers;
use CodeIgnite\Controller;
use App\Models\ProjectsModel;
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
                            'status' => $this->request->getPost('status'),
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
                        'status' => $this->request->getPost('status'),
                        'end_date' => $endDate, // El formato es válido, así que lo puedes guardar directamente
                        'reward_plan' => $this->request->getPost('reward_plan')
                    ];

                 }
				
                error_log('id - '.$projectId);
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
		$projects = $projectModel->getProjects();
		return view('projects/proyects', ['projects' => $projects]);
	}

	public function listMyProjects(): string {   
		if (session('userSessionID') == null) return  view('account/login');
		$projectModel = new ProjectsModel();
		$projects = $projectModel->getProjectsByUserId(session('userSessionID'));
		return view('projects/myProjects', ['projects' => $projects]);
	}

	public function detail($id): string {   
		if (session('userSessionName') == null) return  view('account/login');
		$projectModel = new ProjectsModel();
		$project = $projectModel->getProjectWithInvestmentTotal($id);

		if (!$project) {
			return redirect()->to(base_url('/')); // Redirigir si no se encuentra el proyecto
		}
		return view('projects/detalleProjet', ['project' => $project]);
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
		$success = $projectModel->cancelProject($projectId);  
		
		if ($success) {
			return redirect()->to('projects/myList')->with('success', 'El proyecto y sus inversiones fueron cancelados.');
		} else {
			return redirect()->to('projects/myList')->with('error', 'Hubo un error al cancelar el proyecto.');
		}    
	}

	public function final_project($id_project) {
		if (session('userSessionName') == null) return  view('account/login');
		$projectModel = new ProjectsModel();
		$project = $projectModel->getProject($id_project);
		if ($project === null) {
			return redirect()->to('projects/myList')->with('error', 'El proyecto no existe.');
		}
		
		$endDate = $project['end_date'];
		 
			if (strtotime($endDate) > strtotime(date('Y-m-d'))) {
				// Si la fecha no es válida, redirigir con error
				return redirect()->to('projects/myList')->with('error', 'No se puede finalizar un proyecto antes de su fecha de finalización.');
			}

		$projectModel->finalProject($id_project);
		return redirect()->to('projects/myList')->with('success', 'Estado del proyecto actualizado correctamente.');
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
		return view('projects/myProjects', ['projects' => $projects]);
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
}