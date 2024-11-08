<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model
{
	protected $table = 'projects';
	protected $primaryKey = 'id_projects';
	protected $returnType  = ProjectsModel::class;
	protected $allowedFields = ["id_users","name","category","impact","budget", "status","end_date", "reward_plan"];

	/**
	* @param false|string $slug
	*
	* @return array|null
	*/

	public function getProjects($slug = false)
	{
		if ($slug === false) {
			return $this->findAll();
		}

		return $this->where(['slug' => $slug])->first();
	}

	public function get_published_projects() {
        return $this->where('status', 'PUBLICADO')->findAll();
    }
}