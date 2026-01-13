<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SalaryAdvanceModel;
use App\Models\EmployeeModel;
use App\Models\CompanyModel;

class AdvanceController extends BaseController
{
    protected SalaryAdvanceModel $advanceModel;

    public function __construct()
    {
        $this->advanceModel = new SalaryAdvanceModel();
    }

    /**
     * List all salary advances
     */
    public function index()
    {
        $status = $this->request->getGet('status');

        $builder = $this->advanceModel->builder();
        $builder->select('salary_advances.*, employees.first_name, employees.last_name, employees.email as employee_email, companies.company_name')
                ->join('employees', 'employees.id = salary_advances.employee_id')
                ->join('companies', 'companies.id = salary_advances.company_id');

        if ($status) {
            $builder->where('salary_advances.status', $status);
        }

        $advances = $builder->orderBy('salary_advances.created_at', 'DESC')
                           ->get()
                           ->getResultArray();

        $counts = [
            'total'     => $this->advanceModel->countAllResults(),
            'pending'   => $this->advanceModel->where('status', 'pending')->countAllResults(),
            'approved'  => $this->advanceModel->where('status', 'approved')->countAllResults(),
            'disbursed' => $this->advanceModel->where('status', 'disbursed')->countAllResults(),
            'repaid'    => $this->advanceModel->where('status', 'repaid')->countAllResults(),
            'rejected'  => $this->advanceModel->where('status', 'rejected')->countAllResults(),
        ];

        return view('admin/advances/index', [
            'pageTitle'     => 'Salary Advances',
            'userType'      => 'admin',
            'advances'      => $advances,
            'counts'        => $counts,
            'currentStatus' => $status,
        ]);
    }

    /**
     * View advance details
     */
    public function view(int $id)
    {
        $advance = $this->advanceModel->find($id);

        if (!$advance) {
            return redirect()->to('/admin/advances')->with('error', 'Advance not found');
        }

        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($advance['employee_id']);

        $companyModel = new CompanyModel();
        $company = $companyModel->find($advance['company_id']);

        return view('admin/advances/view', [
            'pageTitle' => 'Advance #' . $advance['id'],
            'userType'  => 'admin',
            'advance'   => $advance,
            'employee'  => $employee,
            'company'   => $company,
        ]);
    }
}
