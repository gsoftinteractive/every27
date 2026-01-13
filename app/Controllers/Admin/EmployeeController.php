<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\CompanyModel;
use App\Models\WalletModel;

class EmployeeController extends BaseController
{
    protected EmployeeModel $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    /**
     * List all employees
     */
    public function index()
    {
        $companyId = $this->request->getGet('company');
        $status = $this->request->getGet('status');

        $builder = $this->employeeModel->builder();
        $builder->select('employees.*, companies.company_name')
                ->join('companies', 'companies.id = employees.company_id');

        if ($companyId) {
            $builder->where('employees.company_id', $companyId);
        }
        if ($status) {
            $builder->where('employees.status', $status);
        }

        $employees = $builder->orderBy('employees.created_at', 'DESC')
                            ->get()
                            ->getResultArray();

        // Get companies for filter
        $companyModel = new CompanyModel();
        $companies = $companyModel->findAll();

        // Get counts
        $counts = [
            'total'     => $this->employeeModel->countAllResults(),
            'active'    => $this->employeeModel->where('status', 'active')->countAllResults(),
            'inactive'  => $this->employeeModel->where('status', 'inactive')->countAllResults(),
            'companies' => count($companies),
        ];

        // Get search parameter
        $search = $this->request->getGet('search');

        return view('admin/employees/index', [
            'pageTitle'      => 'Employees',
            'userType'       => 'admin',
            'employees'      => $employees,
            'counts'         => $counts,
            'companies'      => $companies,
            'currentCompany' => $companyId,
            'currentStatus'  => $status,
            'search'         => $search,
        ]);
    }

    /**
     * View employee details
     */
    public function view(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee) {
            return redirect()->to('/admin/employees')->with('error', 'Employee not found');
        }

        $companyModel = new CompanyModel();
        $company = $companyModel->find($employee['company_id']);

        $walletModel = new WalletModel();
        $wallet = $walletModel->getEmployeeWallet($id);

        return view('admin/employees/view', [
            'pageTitle' => $employee['first_name'] . ' ' . $employee['last_name'],
            'userType'  => 'admin',
            'employee'  => $employee,
            'company'   => $company,
            'wallet'    => $wallet,
        ]);
    }
}
