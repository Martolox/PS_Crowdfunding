<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model
{
	protected $table = 'projects';
	protected $primaryKey = 'id_projects';
	protected $returnType  = 'array';//ProjectsModel::class;
	protected $dateFormat = 'date'; // o 'date', 'timestamp'
	protected $allowedFields = ["id_users","name","category","impact","budget", "status","end_date", "reward_plan"];

	/**
	* @param false|string $slug
	*
	* @return array|null
	*/


	public function insert_project($data) {
		error_log("llege al model".json_encode($data));
       
		return $this->insert($data);
		// return $this->save('projects', $data);
    }

    public function update_project($id, $data) {
        $this->where('id', $id);
        return $this->save('projects', $data);
    }

  
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

	public function getProjectsByUserId($userId)
    {
        return $this->where('id_users', $userId)->findAll();
    }
}