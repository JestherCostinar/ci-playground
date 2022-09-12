<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->userModel = new AuthModel();
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

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]|max_length[50]|is_unique[users.email]',
                'confirmPassword' => 'required|matches[password]'
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                return view('Users/create', $data);
            } else {
                $postData = [
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                ];
                $this->userModel->save($postData);
                session()->setFlashData('success', 'Created Successfully');
                return redirect()->to('user/create');
            }

            exit;
        }

        return view('Users/create', $data);
    }

    public function update($id = null) {
        $data = [
            'title' => 'Update',
            'user' => $this->userModel->where('id', $id)->first()
        ];

        if ($this->request->getMethod() === 'post') {

            // Validation
            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
            ];

            if ($this->request->getPost('password') != '') {
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

                $this->userModel->update($id, $newData);
                session()->setFlashData('success', 'Successfully Update');
                return redirect()->to('user/update/' . $id);
            }
        }

        return view('Users/update', $data);
    }

    public function delete($id = null) {
        if($this->userModel->where('id', $id)->delete()) 
            return redirect()->to('/user')->with('success', 'Delete successfully');
    }
}
