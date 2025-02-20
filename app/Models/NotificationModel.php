<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
	protected $table = 'notifications';
	protected $primaryKey = 'id_notifications';
	protected $returnType  = 'array';
	protected $dateFormat = 'datetime'; // o 'date', 'timestamp'
	protected $allowedFields = ['id_users', 'description', 'notification_date', 'is_read'];
	// Activar manejo de timestamps si es necesario
	protected $useTimestamps = false;

	public function getNotificationsByUser($userId, $limit = 15) {
		return $this->where('id_users', $userId)
					->orderBy('notification_date', 'DESC')
					->findAll($limit);
	}

	public function markAsRead($notificationId)
    {
        return $this->update($notificationId, ['is_read' => 1]);
    }
}