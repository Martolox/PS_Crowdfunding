<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestmentsModel extends Model
{
	protected $table = 'investments';
	protected $primaryKey = 'id_investments';
	protected $returnType = 'array';
	protected $allowedFields = ['id_projects', 'id_users', 'amount', 'status', 'investment_date'];

	public function updateMonto($id_inversion, $nueva_inversion, $vieja_inversion) {
		if ($nueva_inversion > $vieja_inversion) {
			// Verificar que el nuevo monto sea mayor que el anterior
			return $this->update($id_inversion, ['amount' => $nueva_inversion]); // Actualizar la inversión
		} else {
			return false; // Puedes manejar esto como una excepción o simplemente retornar false
		}
	}
  
	public function eliminarInversion($id_inversion) {
		$investment = $this->find($id_inversion);
		$projectModel = new ProjectsModel();
		$project = $projectModel->find($investment['id_projects']);

		if ($project['status'] !== 'FINALIZADO') {
			return $this->update($id_inversion, ['status' => 'cancelled']);
		} else {
			return false;
		}
	}

	// Función para verificar el estado del proyecto
	public function canInvest($id_project) {
		$db = \Config\Database::connect();
		$builder = $db->table('projects');
		$builder->select('status');
		$builder->where('id_projects', $id_project);
		$query = $builder->get();
		$result = $query->getRow();
		return ($result->status !== 'CANCELADO' && $result->status !== 'FINALIZADO');
	}
   
	// Insertar inversión con verificación de estado del proyecto
	public function insertInvestment($data) {
		if ($this->canInvest($data['id_projects'])) {
			return $this->insert($data);
		} else {
			return false;
		}
	}
  
	public function misInversiones($id_usuario) {
		$builder = $this->db->table($this->table);
		$builder->select('investments.*, projects.name as project_name, projects.end_date as project_end_date');
		$builder->join('projects', 'projects.id_projects = investments.id_projects');
		$builder->where('investments.id_users', $id_usuario);
		$builder->where('investments.status', 'active');
		$builder->where('investments.status','finalized ');

		$query = $builder->get();
		return $query->getResultArray();
	}

	public function updateByProject(int $id_project, array $data): bool {
		return $this->where('id_projects', $id_project)->set($data)->update();
	}
}