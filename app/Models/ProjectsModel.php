<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model
{
	protected $table = 'projects';
	protected $primaryKey = 'id_projects';
	protected $returnType  = 'array';//ProjectsModel::class;
	protected $dateFormat = 'date'; // o 'date', 'timestamp'
	protected $allowedFields = ["id_users","name","category","impact","budget", "status","end_date", "reward_plan", "img_name"];

	/**
	* @param false|string $slug
	*
	* @return array|null
	*/


	public function insert_project($data) {
		
		return $this->insert($data);
		// return $this->save('projects', $data);
    }

    public function update_project($id, $data) {
        $this->where('id', $id);
        return $this->save('projects', $data);
    }

  
	public function getProjects(){
    return $this->whereIn('status', ['PUBLICADO', 'FINALIZADO', 'CANCELADO'])->findAll();
	}

    public function getProject($projectId)
    {
        return $this->where('id_projects', $projectId)->first(); // debemos de ponerle $userId
    }
	public function getProjectsByUserId($userId)
    {
        return $this->where('id_users', $userId)->findAll(); // debemos de ponerle $userId
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

public function filtrarProjets($texto)
{
    $builder = $this->db->table($this->table);
    $builder->like('name', $texto, 'both', true);
    $builder->orLike('impact', $texto, 'both', true);
    $builder->orLike('category', $texto, 'both', true);
    $builder->orLike('status', $texto, true);
    $builder->whereIn('status', ['PUBLICADO', 'FINALIZADO', 'CANCELADO']);

    $query = $builder->get();
    return $query->getResultArray();
}

public function updateProjet($projectId, $newStatus)
{
	$builder = $this->db->table($this->table);
	$builder->set('status', $newStatus);
	$builder->where('id_projects', $projectId);
	$builder->update();

	// Mensaje de éxito dependiendo del nuevo estado
	if($newStatus == 'PUBLICADO') {
		return '¡Proyecto publicado exitosamente!';
	} elseif ($newStatus == 'CANCELADO') {
		return '¡Proyecto cancelado exitosamente!';
	} else {
		return false; // O maneja esto como una excepción si lo prefieres
	}
}

public function filtrarIProjets($texto)
{
    $builder = $this->db->table($this->table);
    $builder->like('name', $texto, 'both', true);
    $builder->orLike('impact', $texto, 'both', true);
    $builder->orLike('category', $texto, 'both', true);
    $builder->orLike('status', $texto, true);
    $builder->whereIn('status', ['PUBLICADO', 'FINALIZADO', 'CANCELADO','EN PROCESO']);

    $query = $builder->get();
    return $query->getResultArray();
}


 /**
     * Cancelar un proyecto y sus inversiones asociadas
     *
     * @param int $id_project
     * @return bool
     */
    public function cancelProject(int $id_project): bool
    {     
        $db = \Config\Database::connect(); // Conexión manual si se requiere transacción
        $db->transStart(); // Iniciar transacción
        
        // Cambiar el estado del proyecto a 'cancelled'
        $this->update($id_project, ['status' => 'CANCELADO']);
        
        // Actualizar inversiones asociadas
        $investmentModel = new InvestmentsModel(); // Asegúrate de tener este modelo creado
        $investmentModel->updateByProject($id_project, ['status' => 'cancelled']);
        $db->transComplete(); // Finalizar transacción

        return $db->transStatus(); // Devuelve true si todo fue exitoso
    }

    public function finalProject(int $id_project): bool
    {     
        $db = \Config\Database::connect(); // Conexión manual si se requiere transacción
        $db->transStart(); // Iniciar transacción
        
        // Cambiar el estado del proyecto a 'finalizado'
        $this->update($id_project, ['status' => 'FINALIZADO']);
        
        // Actualizar inversiones asociadas
        $investmentModel = new InvestmentsModel(); // Asegúrate de tener este modelo creado
        $investmentModel->updateByProject($id_project, ['status' => 'finalized']);
        $db->transComplete(); // Finalizar transacción

        return $db->transStatus(); // Devuelve true si todo fue exitoso
    }

}