<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table 	  = 'users';
    protected $primaryKey = 'id_users';
    protected $returnType = 'array';;
    protected $allowedFields = ['id_users', 'username', 'password', 'email'];

	public function getUsers()
	{
		return $this->findAll();
	}
}