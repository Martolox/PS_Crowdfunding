<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table = 'users';

	/**
	* @param false|string $slug
	*
	* @return array|null
	*/

	/*
	public function getNews($slug = false)
	{
		if ($slug === false) {
			return $this->findAll();
		}
		return $this->where(['slug' => $slug])->first();
	} */
}