<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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

    public function exportuserdata()
    {
        $dateToday = date('Y-m-d');
        $fileName = 'Report-' . $dateToday . '.xlsx';
        $spreadsheet = new Spreadsheet();
        $employees = $this->userModel->findAll();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'First name');
        $sheet->setCellValue('C1', 'Last name');
        $sheet->setCellValue('D1', 'Email');
        $rows = 2;
        foreach ($employees as $val) {
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $val['firstname']);
            $sheet->setCellValue('C' . $rows, $val['lastname']);
            $sheet->setCellValue('D' . $rows, $val['email']);
            $rows++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($fileName));
        flush();
        readfile($fileName);
        exit;
    }
}
