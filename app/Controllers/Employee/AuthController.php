<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class AuthController extends BaseController
{
    protected EmployeeModel $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    /**
     * Display login form
     */
    public function login()
    {
        // Redirect if already logged in
        if (session()->get('employee_logged_in')) {
            return redirect()->to('/employee/dashboard');
        }

        return view('employee/auth/login', [
            'pageTitle' => 'Employee Login',
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

        $employee = $this->employeeModel->where('email', $email)->first();

        if ($employee && password_verify($password, $employee['password'])) {
            if ($employee['status'] !== 'active') {
                return redirect()->back()->withInput()->with('error', 'Your account has been deactivated. Please contact your HR department.');
            }

            // Update last login
            $this->employeeModel->updateLastLogin($employee['id']);

            // Set session data
            session()->set([
                'employee_id'        => $employee['id'],
                'employee_name'      => $employee['first_name'] . ' ' . $employee['last_name'],
                'employee_email'     => $employee['email'],
                'employee_company_id' => $employee['company_id'],
                'employee_status'    => $employee['status'],
                'employee_logged_in' => true,
            ]);

            return redirect()->to('/employee/dashboard')->with('success', 'Welcome back, ' . $employee['first_name']);
        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->remove([
            'employee_id', 'employee_name', 'employee_email',
            'employee_company_id', 'employee_status', 'employee_logged_in'
        ]);
        session()->destroy();

        return redirect()->to('/employee/login')->with('success', 'You have been logged out');
    }

    /**
     * Forgot password form
     */
    public function forgotPassword()
    {
        return view('employee/auth/forgot-password', [
            'pageTitle' => 'Forgot Password',
        ]);
    }

    /**
     * Send password reset link
     */
    public function sendResetLink()
    {
        $email = $this->request->getPost('email');

        $employee = $this->employeeModel->where('email', $email)->first();

        // Always show success message (security)
        if ($employee) {
            // TODO: Generate reset token and send email
        }

        return redirect()->back()->with('success', 'If an account with that email exists, a password reset link has been sent.');
    }
}
