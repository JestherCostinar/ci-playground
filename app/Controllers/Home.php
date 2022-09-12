<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Files\File;

class Home extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
        $this->userModel = new AuthModel();
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
        

        $data = [
            'title' => 'Profile',
            'user' => $this->userModel->where('id', session()->get('id'))->first()
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
                
                $this->userModel->save($newData);
                session()->setFlashData('success', 'Successfully Update');
                return redirect()->to('/profile');
            }
        }

        return view('profile', $data);
    }
    
    public function upload($id) {

        $data = [
            'title' => 'Upload Image'
        ];

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'userfile' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded[userfile]'
                    . '|is_image[userfile]'
                    . '|mime_in[userfile,image/jpg,image/jpeg,image/png]'
                    . '|max_size[userfile, 100]'
                ]
            ];

            if(! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // echo "hi"; exit;
                $image = $this->request->getFile('userfile');
                if (!$image->hasMoved()) {
                    $file_path = WRITEPATH . 'uploads/' . $image->store();
                    $uploaded_fileinfo = new File($file_path);
                    
                    $imageData = [
                        'image' => esc($uploaded_fileinfo->getBasename()),
                        'user_id' => $id
                    ];

                    if($this->userModel->update($id, $imageData)) {
                        $data['Flash_message'] = TRUE;
                    }
                }
            }
        }

        return view('upload', $data);
    }
}
