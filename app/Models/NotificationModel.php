<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id_notifications';
    
    protected $returnType  = 'array';//ProjectsModel::class;
	protected $dateFormat = 'datetime'; // o 'date', 'timestamp'

    // Campos que pueden ser gestionados automáticamente por el modelo
    protected $allowedFields = ['id_users', 'description', 'notification_date'];
    
    // Activar manejo de timestamps si es necesario
    protected $useTimestamps = false;
    //protected $createdField = 'notification_date';

    /**
     * Obtiene las notificaciones de un usuario específico
     *
     * @param int $userId
     * @param int $limit
     * @return array
     */
    public function getNotificationsByUser($userId, $limit = 15)
    {
        return $this->where('id_users', $userId)
                    ->orderBy('notification_date', 'DESC')
                    ->findAll($limit);
    }




}
