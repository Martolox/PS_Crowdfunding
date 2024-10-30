<?php

namespace App\Controllers;

class UsersController extends BaseController
{
    public function index(): string
    {
        return view('users/index');
    }
}