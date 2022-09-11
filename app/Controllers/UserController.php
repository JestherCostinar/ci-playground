<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'users' => $this->userModel->findAll(),
        ];

        return view('Users/index', $data);
    }

    public function create() {
        $data = [
            'title' => 'Create Users'
        ]; 
        
        return view('Users/create', $data);
    }
}
