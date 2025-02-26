<?php

namespace App\Controllers;
use App\Models\UsersModel;

class HomeController extends BaseController
{
	public function index(): string {
		return view('home/index');
	}
}