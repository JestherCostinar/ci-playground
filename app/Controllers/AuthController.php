<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\AuthModel;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);

    }
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];

        if ($this->request->getMethod() === 'post') {

            // Validation
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator; 
            } else {
                $userModel = new AuthModel();
                $user = $userModel->where('email', $this->request->getPost('email'))
                    ->first();
                $validatePassword = (new Hash)->decrypt($this->request->getPost('password'), $user['password']);

                if (!$validatePassword) {
                    session()->setFlashData('loginError', 'Email or Password don\'t match');
                    return redirect()->to('/');
                } else {
                    $this->setUserSession($user);
                    return redirect()->to('/dashboard');
                }
            }
        }
        return view('login', $data);
    }

    public function signup()
    {
        $data = [
            'title' => 'Register'
        ];

        if($this->request->getMethod() === 'post') {

            // Validation
            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'confirmPassword' => 'required|matches[password]',
            ];

            $errors = [
                'confirmPassword' => [
                    'matches' => 'Password and confirm password is not match'
                ]
            ];

            if(! $this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $userModel = new AuthModel();
                $newData = [
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                ];
                $userModel->save($newData);
                session()->setFlashData('success', 'Register Successfully');
                return redirect()->to('/');
            }
        }

        return view('signup', $data);
    }

    public function setUserSession($user) {
        $data = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'isLoggedIn' => true
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
