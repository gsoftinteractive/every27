<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\PayrollItemModel;
use App\Models\EmployeeModel;
use App\Models\CompanyModel;

class PayslipController extends BaseController
{
    protected PayrollItemModel $payrollItemModel;
    protected int $employeeId;

    public function __construct()
    {
        $this->payrollItemModel = new PayrollItemModel();
        $this->employeeId = session()->get('employee_id');
    }

    /**
     * List payslips
     */
    public function index()
    {
        $payslips = $this->payrollItemModel->getEmployeePayslips($this->employeeId);

        return view('employee/payslips/index', [
            'pageTitle' => 'My Payslips',
            'payslips'  => $payslips,
        ]);
    }

    /**
     * View payslip
     */
    public function view(int $id)
    {
        $payslip = $this->payrollItemModel->select('payroll_items.*, payroll_runs.payroll_month, payroll_runs.pay_date, payroll_runs.reference')
                                          ->join('payroll_runs', 'payroll_runs.id = payroll_items.payroll_run_id')
                                          ->where('payroll_items.id', $id)
                                          ->where('payroll_items.employee_id', $this->employeeId)
                                          ->first();

        if (!$payslip) {
            return redirect()->to('/employee/payslips')->with('error', 'Payslip not found');
        }

        $employeeModel = new EmployeeModel();
        $companyModel = new CompanyModel();

        $employee = $employeeModel->find($this->employeeId);
        $company = $companyModel->find($employee['company_id']);

        return view('employee/payslips/view', [
            'pageTitle' => 'Payslip - ' . date('F Y', strtotime($payslip['payroll_month'] . '-01')),
            'payslip'   => $payslip,
            'employee'  => $employee,
            'company'   => $company,
        ]);
    }

    /**
     * Download payslip as PDF
     */
    public function download(int $id)
    {
        $payslip = $this->payrollItemModel->select('payroll_items.*, payroll_runs.payroll_month, payroll_runs.pay_date, payroll_runs.reference')
                                          ->join('payroll_runs', 'payroll_runs.id = payroll_items.payroll_run_id')
                                          ->where('payroll_items.id', $id)
                                          ->where('payroll_items.employee_id', $this->employeeId)
                                          ->first();

        if (!$payslip) {
            return redirect()->to('/employee/payslips')->with('error', 'Payslip not found');
        }

        $employeeModel = new EmployeeModel();
        $companyModel = new CompanyModel();

        $employee = $employeeModel->find($this->employeeId);
        $company = $companyModel->find($employee['company_id']);

        // Generate simple HTML for printing/saving as PDF
        $html = view('employee/payslips/pdf', [
            'payslip'  => $payslip,
            'employee' => $employee,
            'company'  => $company,
        ]);

        // Return HTML that can be printed to PDF
        return $this->response->setHeader('Content-Type', 'text/html')
                              ->setBody($html);
    }
}
