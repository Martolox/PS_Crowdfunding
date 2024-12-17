<?php

namespace App\Models;

use CodeIgniter\Model;

class UpdatesModel extends Model
{
    protected $table = 'updates';
    protected $primaryKey = 'id_updates';

    // Campos que serán insertados o actualizados
    protected $allowedFields = ['version', 'change_date', 'description', 'id_projects'];

    // Tipos de datos para cada campo
    protected $returnType = 'array';
    protected $useTimestamps = false; // No usar "created_at" y "updated_at" automáticamente

    // Validación opcional
    protected $validationRules = [
        'version' => 'required|numeric',
        'change_date' => 'required|valid_date',
        'description' => 'required|string|max_length[255]',
        'id_projects' => 'required|numeric|is_not_unique[projects.id_projects]'
    ];

    protected $validationMessages = [];
}
