<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentsModel extends Model
{
	protected $table = 'comments';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = ['id_projects', 'id_users', 'comment', 'email'];

	public function getCommentsByProjectId($projectId): array {
		return $this->where('id_projects', $projectId)->findAll();
	}

	public function getCommentsByUser($userId, $limit = 15)	{
		return $this->where('id', $userId)
					->orderBy('comments_date', 'DESC')
					->findAll($limit);
	}
}