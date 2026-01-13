<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;

class AdminUserController extends BaseController
{
    protected AdminUserModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminUserModel();
    }

    /**
     * List all admin users
     */
    public function index()
    {
        $admins = $this->adminModel->orderBy('created_at', 'DESC')->findAll();

        return view('admin/users/index', [
            'pageTitle' => 'Admin Users',
            'userType'  => 'admin',
            'admins'    => $admins,
        ]);
    }

    /**
     * Create new admin form
     */
    public function create()
    {
        return view('admin/users/create', [
            'pageTitle' => 'Create Admin User',
            'userType'  => 'admin',
        ]);
    }

    /**
     * Store new admin
     */
    public function store()
    {
        $rules = [
            'name'     => 'required|min_length[2]',
            'email'    => 'required|valid_email|is_unique[admin_users.email]',
            'password' => 'required|min_length[8]',
            'role'     => 'required|in_list[super_admin,admin,support]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
            'status'   => 'active',
        ];

        if ($this->adminModel->insert($data)) {
            return redirect()->to('/admin/users')->with('success', 'Admin user created successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create admin user');
    }

    /**
     * Edit admin form
     */
    public function edit(int $id)
    {
        $admin = $this->adminModel->find($id);

        if (!$admin) {
            return redirect()->to('/admin/users')->with('error', 'Admin user not found');
        }

        return view('admin/users/edit', [
            'pageTitle' => 'Edit Admin User',
            'userType'  => 'admin',
            'admin'     => $admin,
        ]);
    }

    /**
     * Update admin
     */
    public function update(int $id)
    {
        $admin = $this->adminModel->find($id);

        if (!$admin) {
            return redirect()->to('/admin/users')->with('error', 'Admin user not found');
        }

        $rules = [
            'name'  => 'required|min_length[2]',
            'email' => 'required|valid_email|is_unique[admin_users.email,id,' . $id . ']',
            'role'  => 'required|in_list[super_admin,admin,support]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role'  => $this->request->getPost('role'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            if (strlen($password) < 8) {
                return redirect()->back()->withInput()->with('error', 'Password must be at least 8 characters');
            }
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($this->adminModel->update($id, $data)) {
            return redirect()->to('/admin/users')->with('success', 'Admin user updated successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update admin user');
    }

    /**
     * Delete admin
     */
    public function delete(int $id)
    {
        $currentAdminId = session()->get('admin_id');

        if ($id == $currentAdminId) {
            return redirect()->back()->with('error', 'You cannot delete your own account');
        }

        if ($this->adminModel->delete($id)) {
            return redirect()->to('/admin/users')->with('success', 'Admin user deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete admin user');
    }
}
