<?php

namespace App\Models;

use CodeIgniter\Model;

class ScoresModel extends Model
{
	protected $table 	  = 'scores';
    protected $primaryKey = 'id_score';
    protected $returnType = 'array';
    protected $allowedFields = ['id_score', 'id_projects', 'id_users', 'score', 'score_date'];

	public function getScores() {
		return $this->findAll();
	}
}