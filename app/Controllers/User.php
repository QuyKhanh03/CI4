<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }
    public function formLogin()
    {
        echo view('user/login');
    }
    public function login()
    {
        $rules = [
            'id' => 'required',
            'password' => 'required',
        ];
        $custom_errors = [
            'id' => [
                'required' => 'ID không được để trống',
            ],
            'password' => [
                'required' => 'Mật khẩu không được để trống',
            ],
        ];

        if (!$this->validate($rules, $custom_errors)) {
            $this->session->setFlashdata('error', 'Đăng nhập thất bại');
            $data['validation'] = $this->validator;
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            echo view('user/login');
        } else {
            $id = $this->request->getPost('id');
            $password = $this->request->getPost('password');
            $user = $this->userModel->where('id', $id)->first();
            if (!$user) {
                $this->session->setFlashdata('error', 'ID không tồn tại');
                return redirect()->to('/login');
            } else {
                if ($password == $user['password']) {
                    $this->session->set('user', $user);
                    return redirect()->to('/users');
                } else {
                    $this->session->setFlashdata('error', 'Mật khẩu không đúng');
                    return redirect()->to('/login');
                }
            }
        }
    }
    public function logout()
    {
        $this->session->remove('user');
        return redirect()->to('/login');
    }

  

    public function index()
    {
        if (!$this->session->get('user')) {
            return redirect()->to('/login');
        } else {
            $search = '';
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
            }
            $total_record = $this->userModel->countAll(); 
            
            $limit = 3;
            $display_page = 3; 
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1; 
            $total_page = ceil($total_record / $limit); 
            if ($current_page > $total_page) {
                $current_page = $total_page;
            } else if ($current_page < 1) {
                $current_page = 1;
            }
            $start = $current_page;
            $end = $current_page+$display_page;
            $users = $this->userModel->like('name', $search)->paginate($limit, '', $current_page);
            echo view('layout/header');
            echo view('user/index', compact('users', 'current_page', 'total_page', 'display_page', 'start','end',));
            echo view('layout/footer');
        }
    }

    public function create()
    {
        echo view('layout/header');
        echo view('user/create');
        echo view('layout/footer');
    }
    public function validateForm($id = null)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email,id,' . $id . ']',
            'tel' => 'required|numeric|min_length[10]|max_length[14]',

        ];
        $custom_errors = [
            'name' => [
                'min_length' => 'Tên phải có ít nhất 3 ký tự',
                'max_length' => 'Tên không được quá 20 ký tự',
                'required' => 'Tên không được để trống',
                'min_length' => 'Tên phải có ít nhất 3 ký tự',
                'max_length' => 'Tên không được quá 20 ký tự',
            ],
            'email' => [
                'min_length' => 'Email phải có ít nhất 6 ký tự',
                'max_length' => 'Email không được quá 50 ký tự',
                'valid_email' => 'Email không đúng định dạng',
                'required' => 'Email không được để trống',
                'is_unique' => 'Email đã tồn tại',
            ],
            'tel' => [
                'required' => 'Số điện thoại không được để trống',
                'min_length' => 'Số điện thoại phải có ít nhất 10 ký tự',
                'max_length' => 'Số điện thoại không được quá 14 ký tự',
                'numeric' => 'Số điện thoại phải là số',
            ],
        ];
        return $this->validate($rules, $custom_errors);
    }
    public function store()
    {
        if (!$this->validateForm()) {
            $this->session->setFlashdata('error', 'Thêm mới thất bại');
            $data['validation'] = $this->validator;
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            $name = $this->request->getPost('name');
            
            $email = $this->request->getPost('email');
            $tel = $this->request->getPost('tel');
            echo view('layout/header');
            echo view('user/create', compact('name', 'email', 'tel'));
            echo view('layout/footer');
        } else {
            $data = $this->request->getPost();
            
            echo view('layout/header');
            echo view('user/confirmAdd', compact('data'));
            echo view('layout/footer');
        }
    }
    public function confirmAddInfo()
    {
        $data = $this->request->getPost();
        $this->userModel->insert($data);
        $this->session->setFlashdata('success', 'Đăng ký thông tin thành công');
        return redirect()->to('/users/notifi');
    }

    
    public function edit($id)
    {
        $user = $this->userModel->find($id);
        echo view('layout/header');
        echo view('user/edit', compact('user'));
        echo view('layout/footer');
    }
    public function update($id)
    {
        if (!$this->validateForm($id)) {
            $this->session->setFlashdata('error', 'Cập nhật thất bại');
            $data['validation'] = $this->validator;
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to('/users/edit/' . $id);
        } else {
            $data = $this->request->getPost();
            echo view('layout/header');
            echo view('user/confirmInfo', compact('data'));
            echo view('layout/footer');
        }
    }

    public function confirmInfo()
    {
        $data = $this->request->getPost();
        $this->userModel->update($data['id'], $data);
        $this->session->setFlashdata('success', 'Update thông tin thành công');
        return redirect()->to('/users/notifi');
    }
    public function notifi()
    {
        echo view('layout/header');
        echo view('user/notifi');
        echo view('layout/footer');
    }
    public function delete($id)
    {
        $data = $this->userModel->find($id);
        echo view('layout/header');
        echo view('user/confirmDelete', compact('data'));
        echo view('layout/footer');
    }
    public function remove($id)
    {
        $this->userModel->delete($id);
        $this->session->setFlashdata('success', 'Delete thông tin thành công');
        return redirect()->to('/users/notifi');
    }
}
