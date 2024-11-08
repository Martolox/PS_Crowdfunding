<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestmentsModel extends Model
{
    protected $table = 'investments';
    protected $primaryKey = 'id_investments';
    protected $returnType = 'array';
    protected $allowedFields = ['id_projects', 'id_users', 'amount', 'status', 'investment_date'];

    public function updateMonto($id_inversion, $nueva_inversion, $vieja_inversion)
    {       
        if ($nueva_inversion > $vieja_inversion) { // Verificar que el nuevo monto sea mayor que el anterior
            return $this->update($id_inversion, ['amount' => $nueva_inversion]);  // Actualizar la inversión
        } else {
            return false; // Puedes manejar esto como una excepción o simplemente retornar false
        }
    }
  
    public function eliminarInversion($id_inversion)
    {       
        return $this->update($id_inversion, ['status' => 'cancelled']);  
    }
  
    public function misInversiones($id_usuario)
    {
        $builder = $this->db->table($this->table);
        $builder->select('investments.*, projects.name as project_name, projects.end_date as project_end_date');
        $builder->join('projects', 'projects.id_projects = investments.id_projects');
        $builder->where('investments.id_users', $id_usuario);
        $builder->where('investments.status', 'active');

        $query = $builder->get();
        return $query->getResultArray();
    }
}