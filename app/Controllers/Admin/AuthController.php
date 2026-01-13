<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;

class AuthController extends BaseController
{
    protected AdminUserModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminUserModel();
    }

    /**
     * Display login form
     */
    public function login()
    {
        // Redirect if already logged in
        if (session()->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/auth/login', [
            'pageTitle' => 'Admin Login',
        ]);
    }

    /**
     * Process login attempt
     */
    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->authenticate($email, $password);

        if ($admin) {
            // Set session data
            session()->set([
                'admin_id'        => $admin['id'],
                'admin_name'      => $admin['name'],
                'admin_email'     => $admin['email'],
                'admin_role'      => $admin['role'],
                'admin_status'    => $admin['status'],
                'admin_logged_in' => true,
            ]);

            return redirect()->to('/admin/dashboard')->with('success', 'Welcome back, ' . $admin['name']);
        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->remove(['admin_id', 'admin_name', 'admin_email', 'admin_role', 'admin_status', 'admin_logged_in']);
        session()->destroy();

        return redirect()->to('/admin/login')->with('success', 'You have been logged out');
    }
}
