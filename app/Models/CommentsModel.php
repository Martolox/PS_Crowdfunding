<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentsModel extends Model
{
	protected $table = 'comments';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = ['id_projects', 'id_users', 'comment', 'email'];
}