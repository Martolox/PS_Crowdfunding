<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentsModel extends Model
{
	protected $table = 'comments';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = ['id_projects', 'id_users', 'comment', 'email', 'comment_date', 'is_read'];

	public function getCommentsByProjectId($projectId, $limit = 15): array {
		return $this->where('id_projects', $projectId)->findAll();
	}
}