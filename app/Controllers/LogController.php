<?php

namespace App\Controllers;

class LogController extends BaseController
{
	public function logout()
	{
		session()->close();
		return redirect()->to(base_url('login'));
	}

	public function login(): string
	{
		return view('/account/login');
	}

	public function register(): string
	{
		return view('/account/register');
	}
}