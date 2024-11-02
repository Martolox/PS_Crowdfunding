<?php

namespace App\Controllers;

class LogController extends BaseController
{
	public function login(): string
	{
		return view('/account/login');
	}

	public function logout(): string
	{
		session()->close();
		
		return redirect()->to(base_url('/account/login'));
	}

	public function register(): string
	{
		return view('/account/register');
	}

	public function authenticate(): string
	{
		// validar con BD
		// NO autenticado redirect()->to(site_url('login'));
		//SI usuario y pass OK!

		$data = $this->request->getPost(['email', 'pass']);

		$userSession = array(
			'email' => $data['email'],
			'is_logged' => true,
			'role' => 'CLIENTE'
		);
		
		session()->set($userSession);
		
		return redirect()->to(base_url('home'));
	}
}