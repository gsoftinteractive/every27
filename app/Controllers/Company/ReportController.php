<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\PayrollRunModel;
use App\Models\PayrollItemModel;
use App\Models\TransactionModel;
use App\Models\WalletModel;
use App\Models\SalaryAdvanceModel;

class ReportController extends BaseController
{
    protected int $companyId;

    public function __construct()
    {
        $this->companyId = session()->get('company_id');
    }

    /**
     * Reports overview
     */
    public function index()
    {
        $employeeModel = new EmployeeModel();
        $payrollModel = new PayrollRunModel();
        $advanceModel = new SalaryAdvanceModel();
        $walletModel = new WalletModel();
        $transactionModel = new TransactionModel();

        $wallet = $walletModel->getCompanyWallet($this->companyId);

        // Summary stats
        $stats = [
            'total_employees' => $employeeModel->where('company_id', $this->companyId)->countAllResults(),
            'active_employees' => $employeeModel->where('company_id', $this->companyId)
                                                 ->where('status', 'active')
                                                 ->countAllResults(),
            'total_payroll_runs' => $payrollModel->where('company_id', $this->companyId)
                                                  ->where('status', 'completed')
                                                  ->countAllResults(),
            'total_advances' => $advanceModel->where('company_id', $this->companyId)->countAllResults(),
        ];

        // Year to date totals
        $ytdPayroll = $payrollModel->where('company_id', $this->companyId)
                                   ->where('status', 'completed')
                                   ->where('created_at >=', date('Y-01-01'))
                                   ->selectSum('total_net_salary')
                                   ->first();

        $ytdAdvances = $advanceModel->where('company_id', $this->companyId)
                                    ->whereIn('status', ['approved', 'disbursed', 'repaid'])
                                    ->where('created_at >=', date('Y-01-01'))
                                    ->selectSum('amount_approved')
                                    ->first();

        $stats['ytd_payroll'] = (float) ($ytdPayroll['total_net_salary'] ?? 0);
        $stats['ytd_advances'] = (float) ($ytdAdvances['amount_approved'] ?? 0);

        return view('company/reports/index', [
            'pageTitle' => 'Reports',
            'stats' => $stats,
        ]);
    }

    /**
     * Payroll reports
     */
    public function payroll()
    {
        $payrollModel = new PayrollRunModel();
        $payrollItemModel = new PayrollItemModel();

        // Get filters
        $year = $this->request->getGet('year') ?? date('Y');
        $month = $this->request->getGet('month');

        $builder = $payrollModel->where('company_id', $this->companyId)
                                ->where('status', 'completed');

        if ($year) {
            $builder->where('YEAR(created_at)', $year);
        }
        if ($month) {
            $builder->where('payroll_month', $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT));
        }

        $payrolls = $builder->orderBy('created_at', 'DESC')->findAll();

        // Calculate totals
        $totalGross = 0;
        $totalNet = 0;
        $totalDeductions = 0;
        $totalFees = 0;

        foreach ($payrolls as $payroll) {
            $totalGross += (float) $payroll['total_gross_salary'];
            $totalNet += (float) $payroll['total_net_salary'];
            $totalDeductions += (float) $payroll['total_deductions'];
            $totalFees += (float) $payroll['platform_fee'];
        }

        $summary = [
            'total_gross' => $totalGross,
            'total_net' => $totalNet,
            'total_deductions' => $totalDeductions,
            'total_fees' => $totalFees,
            'payroll_count' => count($payrolls),
        ];

        return view('company/reports/payroll', [
            'pageTitle' => 'Payroll Reports',
            'payrolls' => $payrolls,
            'summary' => $summary,
            'filters' => [
                'year' => $year,
                'month' => $month,
            ],
        ]);
    }

    /**
     * Employee reports
     */
    public function employees()
    {
        $employeeModel = new EmployeeModel();
        $advanceModel = new SalaryAdvanceModel();

        $employees = $employeeModel->where('company_id', $this->companyId)
                                   ->orderBy('first_name', 'ASC')
                                   ->findAll();

        // Add advance stats for each employee
        foreach ($employees as &$employee) {
            $advances = $advanceModel->where('employee_id', $employee['id'])
                                     ->whereIn('status', ['approved', 'disbursed', 'repaid'])
                                     ->findAll();

            $employee['total_advances'] = count($advances);
            $employee['total_advance_amount'] = array_sum(array_column($advances, 'amount_approved'));
            $employee['outstanding_advances'] = $advanceModel->where('employee_id', $employee['id'])
                                                              ->where('status', 'disbursed')
                                                              ->countAllResults();
        }

        // Summary
        $summary = [
            'total_employees' => count($employees),
            'active_employees' => count(array_filter($employees, fn($e) => $e['status'] === 'active')),
            'inactive_employees' => count(array_filter($employees, fn($e) => $e['status'] !== 'active')),
            'total_monthly_salary' => array_sum(array_column(
                array_filter($employees, fn($e) => $e['status'] === 'active'),
                'monthly_salary'
            )),
        ];

        return view('company/reports/employees', [
            'pageTitle' => 'Employee Reports',
            'employees' => $employees,
            'summary' => $summary,
        ]);
    }

    /**
     * Transaction reports
     */
    public function transactions()
    {
        $walletModel = new WalletModel();
        $transactionModel = new TransactionModel();

        $wallet = $walletModel->getCompanyWallet($this->companyId);

        if (!$wallet) {
            return view('company/reports/transactions', [
                'pageTitle' => 'Transaction Reports',
                'transactions' => [],
                'summary' => [
                    'total_credits' => 0,
                    'total_debits' => 0,
                    'transaction_count' => 0,
                ],
                'filters' => [],
            ]);
        }

        // Get filters
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');
        $type = $this->request->getGet('type');
        $category = $this->request->getGet('category');

        $builder = $transactionModel->where('wallet_id', $wallet['id'])
                                    ->where('created_at >=', $startDate . ' 00:00:00')
                                    ->where('created_at <=', $endDate . ' 23:59:59');

        if ($type) {
            $builder->where('type', $type);
        }
        if ($category) {
            $builder->where('category', $category);
        }

        $transactions = $builder->orderBy('created_at', 'DESC')->findAll();

        // Calculate summary
        $totalCredits = array_sum(array_column(
            array_filter($transactions, fn($t) => $t['type'] === 'credit'),
            'amount'
        ));
        $totalDebits = array_sum(array_column(
            array_filter($transactions, fn($t) => $t['type'] === 'debit'),
            'amount'
        ));

        $summary = [
            'total_credits' => $totalCredits,
            'total_debits' => $totalDebits,
            'transaction_count' => count($transactions),
            'net_flow' => $totalCredits - $totalDebits,
        ];

        return view('company/reports/transactions', [
            'pageTitle' => 'Transaction Reports',
            'transactions' => $transactions,
            'summary' => $summary,
            'filters' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'type' => $type,
                'category' => $category,
            ],
        ]);
    }
}
