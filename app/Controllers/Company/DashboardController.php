<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Models\EmployeeModel;
use App\Models\WalletModel;
use App\Models\TransactionModel;
use App\Models\SalaryAdvanceModel;
use App\Models\PayrollRunModel;

class DashboardController extends BaseController
{
    protected int $companyId;

    public function __construct()
    {
        $this->companyId = session()->get('company_id');
    }

    /**
     * Company Dashboard
     */
    public function index()
    {
        $companyModel  = new CompanyModel();
        $employeeModel = new EmployeeModel();
        $walletModel   = new WalletModel();
        $advanceModel  = new SalaryAdvanceModel();
        $payrollModel  = new PayrollRunModel();
        $transactionModel = new TransactionModel();

        // Get company details
        $company = $companyModel->find($this->companyId);

        // Get wallet
        $wallet = $walletModel->getCompanyWallet($this->companyId);

        // Statistics
        $stats = [
            'total_employees'  => $employeeModel->where('company_id', $this->companyId)->countAllResults(),
            'active_employees' => $employeeModel->where('company_id', $this->companyId)
                                                ->where('status', 'active')
                                                ->countAllResults(),
            'pending_advances' => $advanceModel->where('company_id', $this->companyId)
                                               ->where('status', 'pending')
                                               ->countAllResults(),
            'wallet_balance'   => $wallet ? (float) $wallet['balance'] : 0,
        ];

        // Calculate total monthly payroll
        $employees = $employeeModel->getActiveByCompany($this->companyId);
        $totalMonthlyPayroll = array_sum(array_column($employees, 'monthly_salary'));
        $platformFee = count($employees) * (float) $company['monthly_fee_per_employee'];
        $stats['monthly_payroll'] = $totalMonthlyPayroll + $platformFee;

        // Recent transactions
        $recentTransactions = [];
        if ($wallet) {
            $recentTransactions = $transactionModel->getRecent($wallet['id'], 5);
        }

        // Pending advances
        $pendingAdvances = $advanceModel->getPendingByCompany($this->companyId);

        // Recent payroll runs
        $recentPayrolls = $payrollModel->where('company_id', $this->companyId)
                                       ->orderBy('created_at', 'DESC')
                                       ->findAll(5);

        // Check if company needs verification
        $needsVerification = $company['verification_status'] !== 'verified';

        return view('company/dashboard', [
            'pageTitle'          => 'Dashboard',
            'company'            => $company,
            'wallet'             => $wallet,
            'stats'              => $stats,
            'recentTransactions' => $recentTransactions,
            'pendingAdvances'    => $pendingAdvances,
            'recentPayrolls'     => $recentPayrolls,
            'needsVerification'  => $needsVerification,
        ]);
    }
}
