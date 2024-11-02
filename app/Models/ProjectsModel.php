<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model
{
	protected $table = 'projects';

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
}