<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\CompanyModel;
use App\Models\WalletModel;
use App\Models\TransactionModel;
use App\Models\SalaryAdvanceModel;
use App\Models\PayrollItemModel;

class DashboardController extends BaseController
{
    protected int $employeeId;

    public function __construct()
    {
        $this->employeeId = session()->get('employee_id');
    }

    /**
     * Employee Dashboard
     */
    public function index()
    {
        $employeeModel = new EmployeeModel();
        $companyModel  = new CompanyModel();
        $walletModel   = new WalletModel();
        $advanceModel  = new SalaryAdvanceModel();
        $payrollItemModel = new PayrollItemModel();
        $transactionModel = new TransactionModel();

        // Get employee details
        $employee = $employeeModel->find($this->employeeId);
        $company  = $companyModel->find($employee['company_id']);

        // Get wallet
        $wallet = $walletModel->getEmployeeWallet($this->employeeId);

        // Check advance eligibility
        $advanceEligibility = $employeeModel->canRequestAdvance($this->employeeId);

        // Statistics
        $stats = [
            'wallet_balance'    => $wallet ? (float) $wallet['balance'] : 0,
            'monthly_salary'    => (float) $employee['monthly_salary'],
            'can_request_advance' => $advanceEligibility['can_request'],
            'max_advance_amount' => $advanceEligibility['max_amount'] ?? 0,
        ];

        // Active advance (if any)
        $activeAdvance = $advanceModel->where('employee_id', $this->employeeId)
                                      ->whereIn('status', ['pending', 'approved', 'disbursed'])
                                      ->first();

        // Recent transactions
        $recentTransactions = [];
        if ($wallet) {
            $recentTransactions = $transactionModel->getRecent($wallet['id'], 5);
        }

        // Recent payslips
        $recentPayslips = $payrollItemModel->getEmployeePayslips($this->employeeId);
        $recentPayslips = array_slice($recentPayslips, 0, 3);

        // Latest payslip
        $latestPayslip = $payrollItemModel->getLatestPayslip($this->employeeId);

        // Days until next payday (27th)
        $today = new \DateTime();
        $currentDay = (int) $today->format('d');
        if ($currentDay <= 27) {
            $daysUntilPayday = 27 - $currentDay;
        } else {
            $nextMonth = (clone $today)->modify('first day of next month');
            $nextPayday = $nextMonth->setDate((int)$nextMonth->format('Y'), (int)$nextMonth->format('m'), 27);
            $daysUntilPayday = $today->diff($nextPayday)->days;
        }

        return view('employee/dashboard', [
            'pageTitle'          => 'Dashboard',
            'employee'           => $employee,
            'company'            => $company,
            'wallet'             => $wallet,
            'stats'              => $stats,
            'activeAdvance'      => $activeAdvance,
            'recentTransactions' => $recentTransactions,
            'recentPayslips'     => $recentPayslips,
            'latestPayslip'      => $latestPayslip,
            'daysUntilPayday'    => $daysUntilPayday,
            'advanceEligibility' => $advanceEligibility,
        ]);
    }
}
