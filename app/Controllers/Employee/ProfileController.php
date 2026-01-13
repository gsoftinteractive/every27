<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\CompanyModel;

class ProfileController extends BaseController
{
    protected EmployeeModel $employeeModel;
    protected int $employeeId;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->employeeId = session()->get('employee_id');
    }

    /**
     * View profile
     */
    public function index()
    {
        $employee = $this->employeeModel->find($this->employeeId);
        $companyModel = new CompanyModel();
        $company = $companyModel->find($employee['company_id']);

        return view('employee/profile/index', [
            'pageTitle' => 'My Profile',
            'employee'  => $employee,
            'company'   => $company,
        ]);
    }

    /**
     * Update profile
     */
    public function update()
    {
        $rules = [
            'phone' => 'permit_empty|min_length[10]|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'phone' => $this->request->getPost('phone'),
        ];

        if ($this->employeeModel->update($this->employeeId, $data)) {
            return redirect()->to('/employee/profile')->with('success', 'Profile updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update profile');
    }

    /**
     * Update password
     */
    public function updatePassword()
    {
        $rules = [
            'current_password' => 'required',
            'new_password'     => 'required|min_length[8]',
            'confirm_password' => 'required|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $employee = $this->employeeModel->find($this->employeeId);

        if (!password_verify($this->request->getPost('current_password'), $employee['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        if ($this->employeeModel->update($this->employeeId, [
            'password' => $this->request->getPost('new_password'),
        ])) {
            return redirect()->to('/employee/profile')->with('success', 'Password updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update password');
    }

    /**
     * Update bank details
     */
    public function updateBankDetails()
    {
        $rules = [
            'bank_name'           => 'required|max_length[100]',
            'bank_account_number' => 'required|min_length[10]|max_length[20]',
            'bank_account_name'   => 'required|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'bank_name'           => $this->request->getPost('bank_name'),
            'bank_account_number' => $this->request->getPost('bank_account_number'),
            'bank_account_name'   => $this->request->getPost('bank_account_name'),
        ];

        if ($this->employeeModel->update($this->employeeId, $data)) {
            return redirect()->to('/employee/profile')->with('success', 'Bank details updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update bank details');
    }
}
