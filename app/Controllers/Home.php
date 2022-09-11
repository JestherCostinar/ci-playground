<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Home extends BaseController
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

        return view('login', $data);
    }

    public function dashboard() {
        $data = [
            'title' => 'Dashboard'
        ];

        return view('dashboard', $data);
    }

    public function profile() {
        $userModel = new AuthModel();

        $data = [
            'title' => 'Profile',
            'user' => $userModel->where('id', session()->get('id'))->first()
        ];

        if ($this->request->getMethod() === 'post') {

            // Validation
            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
            ];

            if($this->request->getPost('password') != '') {
                $rules['password'] = 'required|min_length[8]|max_length[255]';
                $rules['confirmPassword'] = 'required|matches[password]';
            }

            $errors = [
                'confirmPassword' => [
                    'matches' => 'Password and confirm password is not matches'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'id' => session()->get('id'),
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                ];

                if ($this->request->getPost('password') != '') {
                    $newData['password'] = $this->request->getPost('password');
                }
                
                $userModel->save($newData);
                session()->setFlashData('success', 'Successfully Update');
                return redirect()->to('/profile');
            }
        }

        return view('profile', $data);
    }   
}
