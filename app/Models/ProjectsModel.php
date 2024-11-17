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

  
	public function getProjects(){
    return $this->where('status', 'PUBLICADO')->findAll();
}


	public function get_published_projects() {
        return $this->where('status', 'PUBLICADO')
					->where('id_users !=', 4)//$loggedUserId)
					->findAll();
	}

	public function getProjectsByUserId($userId)
    {
        return $this->where('id_users', 1)->findAll(); // debemos de ponerle $userId
    }

	public function getProjectWithInvestmentTotal($project_id)
{
    $builder = $this->db->table('projects');
    $builder->select('projects.*, COALESCE(SUM(investments.amount), 0) as total_investment');
    $builder->join('investments', 'investments.id_projects = projects.id_projects', 'left');
    $builder->where('projects.id_projects', $project_id);
    $builder->groupBy('projects.id_projects');

    $query = $builder->get();
    return $query->getRowArray();
}
}