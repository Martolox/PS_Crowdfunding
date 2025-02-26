<?php

namespace App\Controllers;
use App\Models\CommentsModel;
use App\Models\ProjectsModel;
use CodeIgniter\CLI\Console;

class CommentsController extends BaseController
{
	protected $commentsModel;
	protected $projectsModel;

	public function __construct() {
		$this->commentsModel = new CommentsModel();
		$this->projectsModel = new ProjectsModel();
	}

	public function getUnreadComments() {
		$projects = $this->projectsModel->getProjectsByUserId(session('userSessionID'));
		$comments = [];
		foreach ($projects as $p) {
			$projectComments = $this->commentsModel->where('id_projects', $p['id_projects'])
												->where('is_read', 0)
												->orderBy('comment_date', 'DESC')
												->findAll();
			$comments = array_merge($comments, $projectComments);
		}

		return $this->response->setJSON([
			'status' => 'success',
			'count' => count($comments),
			'data' => $comments
		]);
	}

	public function create() {
		if (session('userSessionName') == null) return  view('account/login');
		$model = model(CommentsModel::class);

		$data = array('id_projects' => $_POST['id_projects'],
					  'id_users' => session('userSessionID'),
					  'comment' => $_POST['cMessage'],
					  'email' => session('userSessionEmail'));
		$model->insert($data);

		return redirect()->to($_POST['url'])->with('success', 'Mensaje enviado satisfactoriamente');
	}

	public function markAsRead($id) {
		$comment = $this->commentsModel->find($id);

		if (!$comment) {
			return $this->response->setJSON([
				'status' => 'error',
				'message' => 'Comentario no encontrado.'
			])->setStatusCode(404);
		}

		$this->commentsModel->update($id, ['is_read' => 1]);

		return $this->response->setJSON([
			'status' => 'success',
			'message' => 'Comentario marcado como leído.'
		]);
	}

	public function listMyComments(): string {   
		$projects = $this->projectsModel->getProjectsByUserId(session('userSessionID'));
		$comments = [];
		foreach ($projects as $p) {
			$projectComments = $this->commentsModel	->where('id_projects', $p['id_projects'])
													->orderBy('comment_date', 'DESC')
													->findAll();
			$comments = array_merge($comments, $projectComments);
		}
		
		return view('notifications/my_comments', ['comments' => $comments]);
	}
}