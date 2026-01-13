<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\PayrollRunModel;
use App\Models\PayrollItemModel;
use App\Models\EmployeeModel;
use App\Models\CompanyModel;
use App\Models\WalletModel;

class PayrollController extends BaseController
{
    protected PayrollRunModel $payrollModel;
    protected int $companyId;

    public function __construct()
    {
        $this->payrollModel = new PayrollRunModel();
        $this->companyId = session()->get('company_id');
    }

    /**
     * List payroll runs
     */
    public function index()
    {
        $payrollRuns = $this->payrollModel->getByCompany($this->companyId);

        return view('company/payroll/index', [
            'pageTitle'   => 'Payroll',
            'payrollRuns' => $payrollRuns,
        ]);
    }

    /**
     * Create new payroll form
     */
    public function create()
    {
        $employeeModel = new EmployeeModel();
        $companyModel = new CompanyModel();
        $walletModel = new WalletModel();

        $company = $companyModel->find($this->companyId);
        $employees = $employeeModel->getActiveByCompany($this->companyId);
        $wallet = $walletModel->getCompanyWallet($this->companyId);

        // Calculate expected payroll
        $totalGross = array_sum(array_column($employees, 'monthly_salary'));
        $platformFee = count($employees) * (float) $company['monthly_fee_per_employee'];
        $totalAmount = $totalGross + $platformFee;

        // Default to current month
        $payrollMonth = date('Y-m');
        $payDate = date('Y-m-27');

        // Check if payroll already exists for this month
        $existingPayroll = $this->payrollModel->where('company_id', $this->companyId)
                                              ->where('payroll_month', $payrollMonth)
                                              ->whereNotIn('status', ['cancelled', 'failed'])
                                              ->first();

        return view('company/payroll/create', [
            'pageTitle'       => 'Create Payroll',
            'company'         => $company,
            'employees'       => $employees,
            'wallet'          => $wallet,
            'totalGross'      => $totalGross,
            'platformFee'     => $platformFee,
            'totalAmount'     => $totalAmount,
            'payrollMonth'    => $payrollMonth,
            'payDate'         => $payDate,
            'existingPayroll' => $existingPayroll,
        ]);
    }

    /**
     * Store new payroll
     */
    public function store()
    {
        $payrollMonth = $this->request->getPost('payroll_month');
        $payDate = $this->request->getPost('pay_date');

        if (empty($payrollMonth) || empty($payDate)) {
            return redirect()->back()->with('error', 'Please select payroll month and pay date');
        }

        $result = $this->payrollModel->createPayrollRun(
            $this->companyId,
            $payrollMonth,
            $payDate,
            'manual'
        );

        if ($result['success']) {
            return redirect()->to('/company/payroll/' . $result['payroll_id'])
                           ->with('success', 'Payroll created successfully. Review and process when ready.');
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * View payroll details
     */
    public function view(int $id)
    {
        $payroll = $this->payrollModel->find($id);

        if (!$payroll || $payroll['company_id'] != $this->companyId) {
            return redirect()->to('/company/payroll')->with('error', 'Payroll not found');
        }

        $payrollItemModel = new PayrollItemModel();
        $items = $payrollItemModel->getByPayrollRun($id);

        return view('company/payroll/view', [
            'pageTitle' => 'Payroll - ' . date('F Y', strtotime($payroll['payroll_month'] . '-01')),
            'payroll'   => $payroll,
            'items'     => $items,
        ]);
    }

    /**
     * Process payroll
     */
    public function process(int $id)
    {
        $payroll = $this->payrollModel->find($id);

        if (!$payroll || $payroll['company_id'] != $this->companyId) {
            return redirect()->to('/company/payroll')->with('error', 'Payroll not found');
        }

        if (!in_array($payroll['status'], ['draft', 'scheduled'])) {
            return redirect()->back()->with('error', 'Payroll cannot be processed');
        }

        $result = $this->payrollModel->processPayroll($id);

        if ($result['success']) {
            return redirect()->to('/company/payroll/' . $id)
                           ->with('success', 'Payroll processed successfully! Employees have been paid.');
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Cancel payroll
     */
    public function cancel(int $id)
    {
        $payroll = $this->payrollModel->find($id);

        if (!$payroll || $payroll['company_id'] != $this->companyId) {
            return redirect()->to('/company/payroll')->with('error', 'Payroll not found');
        }

        if (!in_array($payroll['status'], ['draft', 'scheduled'])) {
            return redirect()->back()->with('error', 'Only draft or scheduled payrolls can be cancelled');
        }

        if ($this->payrollModel->update($id, ['status' => 'cancelled'])) {
            return redirect()->to('/company/payroll')->with('success', 'Payroll cancelled');
        }

        return redirect()->back()->with('error', 'Failed to cancel payroll');
    }
}
