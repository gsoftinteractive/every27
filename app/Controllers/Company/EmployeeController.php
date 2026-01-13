<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\WalletModel;

class EmployeeController extends BaseController
{
    protected EmployeeModel $employeeModel;
    protected int $companyId;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->companyId = session()->get('company_id');
    }

    /**
     * List employees
     */
    public function index()
    {
        $status = $this->request->getGet('status');

        if ($status) {
            $employees = $this->employeeModel->where('company_id', $this->companyId)
                                            ->where('status', $status)
                                            ->findAll();
        } else {
            $employees = $this->employeeModel->getByCompany($this->companyId);
        }

        $counts = [
            'total'      => $this->employeeModel->where('company_id', $this->companyId)->countAllResults(),
            'active'     => $this->employeeModel->where('company_id', $this->companyId)->where('status', 'active')->countAllResults(),
            'suspended'  => $this->employeeModel->where('company_id', $this->companyId)->where('status', 'suspended')->countAllResults(),
            'terminated' => $this->employeeModel->where('company_id', $this->companyId)->where('status', 'terminated')->countAllResults(),
        ];

        return view('company/employees/index', [
            'pageTitle'     => 'Employees',
            'employees'     => $employees,
            'counts'        => $counts,
            'currentStatus' => $status,
        ]);
    }

    /**
     * Create employee form
     */
    public function create()
    {
        return view('company/employees/create', [
            'pageTitle' => 'Add Employee',
        ]);
    }

    /**
     * Store new employee
     */
    public function store()
    {
        $rules = [
            'first_name'     => 'required|min_length[2]|max_length[100]',
            'last_name'      => 'required|min_length[2]|max_length[100]',
            'email'          => 'required|valid_email|is_unique[employees.email]',
            'phone'          => 'permit_empty|min_length[10]',
            'monthly_salary' => 'required|decimal',
            'department'     => 'permit_empty|max_length[100]',
            'position'       => 'permit_empty|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Generate a random password
        $password = bin2hex(random_bytes(4));

        $employeeId = $this->employeeModel->insert([
            'company_id'     => $this->companyId,
            'first_name'     => $this->request->getPost('first_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'email'          => $this->request->getPost('email'),
            'password'       => $password,
            'phone'          => $this->request->getPost('phone'),
            'department'     => $this->request->getPost('department'),
            'position'       => $this->request->getPost('position'),
            'monthly_salary' => $this->request->getPost('monthly_salary'),
            'hire_date'      => $this->request->getPost('hire_date') ?: date('Y-m-d'),
            'status'         => 'active',
        ]);

        if ($employeeId) {
            // Create employee wallet
            $walletModel = new WalletModel();
            $walletModel->createEmployeeWallet($employeeId);

            // TODO: Send welcome email with credentials

            return redirect()->to('/company/employees/' . $employeeId)
                           ->with('success', 'Employee added successfully. Password: ' . $password);
        }

        return redirect()->back()->withInput()->with('error', 'Failed to add employee');
    }

    /**
     * View employee details
     */
    public function view(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee || $employee['company_id'] != $this->companyId) {
            return redirect()->to('/company/employees')->with('error', 'Employee not found');
        }

        $walletModel = new WalletModel();
        $wallet = $walletModel->getEmployeeWallet($id);

        return view('company/employees/view', [
            'pageTitle' => $employee['first_name'] . ' ' . $employee['last_name'],
            'employee'  => $employee,
            'wallet'    => $wallet,
        ]);
    }

    /**
     * Edit employee form
     */
    public function edit(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee || $employee['company_id'] != $this->companyId) {
            return redirect()->to('/company/employees')->with('error', 'Employee not found');
        }

        return view('company/employees/edit', [
            'pageTitle' => 'Edit ' . $employee['first_name'],
            'employee'  => $employee,
        ]);
    }

    /**
     * Update employee
     */
    public function update(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee || $employee['company_id'] != $this->companyId) {
            return redirect()->to('/company/employees')->with('error', 'Employee not found');
        }

        $rules = [
            'first_name'     => 'required|min_length[2]|max_length[100]',
            'last_name'      => 'required|min_length[2]|max_length[100]',
            'email'          => 'required|valid_email|is_unique[employees.email,id,' . $id . ']',
            'phone'          => 'permit_empty|min_length[10]',
            'monthly_salary' => 'required|decimal',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'first_name'     => $this->request->getPost('first_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'email'          => $this->request->getPost('email'),
            'phone'          => $this->request->getPost('phone'),
            'department'     => $this->request->getPost('department'),
            'position'       => $this->request->getPost('position'),
            'monthly_salary' => $this->request->getPost('monthly_salary'),
        ];

        // Only update password if provided
        if ($password = $this->request->getPost('password')) {
            $data['password'] = $password;
        }

        if ($this->employeeModel->update($id, $data)) {
            return redirect()->to('/company/employees/' . $id)->with('success', 'Employee updated successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update employee');
    }

    /**
     * Deactivate employee
     */
    public function deactivate(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee || $employee['company_id'] != $this->companyId) {
            return redirect()->to('/company/employees')->with('error', 'Employee not found');
        }

        if ($this->employeeModel->update($id, ['status' => 'suspended'])) {
            return redirect()->back()->with('success', 'Employee deactivated');
        }

        return redirect()->back()->with('error', 'Failed to deactivate employee');
    }

    /**
     * Activate employee
     */
    public function activate(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee || $employee['company_id'] != $this->companyId) {
            return redirect()->to('/company/employees')->with('error', 'Employee not found');
        }

        if ($this->employeeModel->update($id, ['status' => 'active'])) {
            return redirect()->back()->with('success', 'Employee activated');
        }

        return redirect()->back()->with('error', 'Failed to activate employee');
    }

    /**
     * Import employees from CSV
     */
    public function import()
    {
        $file = $this->request->getFile('csv_file');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid CSV file');
        }

        if ($file->getExtension() !== 'csv') {
            return redirect()->back()->with('error', 'Only CSV files are allowed');
        }

        $handle = fopen($file->getTempName(), 'r');
        $header = fgetcsv($handle);

        $imported = 0;
        $errors = [];
        $walletModel = new WalletModel();

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            // Generate password
            $password = bin2hex(random_bytes(4));

            $employeeId = $this->employeeModel->insert([
                'company_id'     => $this->companyId,
                'first_name'     => $data['first_name'] ?? '',
                'last_name'      => $data['last_name'] ?? '',
                'email'          => $data['email'] ?? '',
                'password'       => $password,
                'phone'          => $data['phone'] ?? '',
                'department'     => $data['department'] ?? '',
                'position'       => $data['position'] ?? '',
                'monthly_salary' => $data['monthly_salary'] ?? 0,
                'status'         => 'active',
            ]);

            if ($employeeId) {
                $walletModel->createEmployeeWallet($employeeId);
                $imported++;
            } else {
                $errors[] = $data['email'] ?? 'Unknown';
            }
        }

        fclose($handle);

        $message = "Imported {$imported} employees successfully.";
        if (!empty($errors)) {
            $message .= " Failed: " . implode(', ', array_slice($errors, 0, 5));
        }

        return redirect()->to('/company/employees')->with('success', $message);
    }
}
