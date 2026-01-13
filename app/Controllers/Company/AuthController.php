<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\CompanyModel;

class AuthController extends BaseController
{
    protected CompanyModel $companyModel;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
    }

    /**
     * Display login form
     */
    public function login()
    {
        // Redirect if already logged in
        if (session()->get('company_logged_in')) {
            return redirect()->to('/company/dashboard');
        }

        return view('company/auth/login', [
            'pageTitle' => 'Company Login',
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

        $company = $this->companyModel->where('email', $email)->first();

        if ($company && password_verify($password, $company['password'])) {
            if ($company['status'] !== 'active') {
                return redirect()->back()->withInput()->with('error', 'Your account has been suspended. Please contact support.');
            }

            // Set session data
            session()->set([
                'company_id'          => $company['id'],
                'company_name'        => $company['company_name'],
                'company_email'       => $company['email'],
                'company_status'      => $company['status'],
                'company_verified'    => $company['verification_status'] === 'verified',
                'company_logged_in'   => true,
            ]);

            return redirect()->to('/company/dashboard')->with('success', 'Welcome back!');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->remove([
            'company_id', 'company_name', 'company_email',
            'company_status', 'company_verified', 'company_logged_in'
        ]);
        session()->destroy();

        return redirect()->to('/company/login')->with('success', 'You have been logged out');
    }

    /**
     * Forgot password form
     */
    public function forgotPassword()
    {
        return view('company/auth/forgot-password', [
            'pageTitle' => 'Forgot Password',
        ]);
    }

    /**
     * Send password reset link
     */
    public function sendResetLink()
    {
        $email = $this->request->getPost('email');

        $company = $this->companyModel->where('email', $email)->first();

        // Always show success message (security)
        if ($company) {
            // TODO: Generate reset token and send email
        }

        return redirect()->back()->with('success', 'If an account with that email exists, a password reset link has been sent.');
    }
}
