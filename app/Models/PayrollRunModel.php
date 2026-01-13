<?php

namespace App\Models;

use CodeIgniter\Model;

class PayrollRunModel extends Model
{
    protected $table            = 'payroll_runs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'reference',
        'company_id',
        'payroll_month',
        'pay_date',
        'total_employees',
        'total_gross_salary',
        'total_deductions',
        'total_net_salary',
        'platform_fee',
        'total_amount',
        'status',
        'initiated_by',
        'error_message',
        'processed_at',
        'completed_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $beforeInsert = ['generateReference'];

    protected function generateReference(array $data): array
    {
        if (empty($data['data']['reference'])) {
            $data['data']['reference'] = 'PAY' . date('YmdHis') . strtoupper(bin2hex(random_bytes(4)));
        }
        return $data;
    }

    /**
     * Create payroll run for company
     */
    public function createPayrollRun(int $companyId, string $payrollMonth, string $payDate, string $initiatedBy = 'system'): array
    {
        // Check if payroll already exists for this month
        $existing = $this->where('company_id', $companyId)
                        ->where('payroll_month', $payrollMonth)
                        ->whereNotIn('status', ['cancelled', 'failed'])
                        ->first();

        if ($existing) {
            return ['success' => false, 'message' => 'Payroll already exists for this month'];
        }

        // Get company employees
        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->getActiveByCompany($companyId);

        if (empty($employees)) {
            return ['success' => false, 'message' => 'No active employees found'];
        }

        // Get company and platform fee
        $companyModel = new CompanyModel();
        $company = $companyModel->find($companyId);
        $feePerEmployee = (float) $company['monthly_fee_per_employee'];

        // Calculate totals
        $totalGross = 0;
        $totalDeductions = 0;
        $employeeCount = count($employees);

        // Get active advances for deductions
        $advanceModel = new SalaryAdvanceModel();
        $activeAdvances = $advanceModel->getActiveAdvances($companyId);
        $advancesByEmployee = [];

        foreach ($activeAdvances as $advance) {
            $advancesByEmployee[$advance['employee_id']] = $advance;
        }

        // Calculate each employee's net salary
        $payrollItems = [];
        foreach ($employees as $employee) {
            $gross = (float) $employee['monthly_salary'];
            $advanceDeduction = 0;

            if (isset($advancesByEmployee[$employee['id']])) {
                $advanceDeduction = (float) $advancesByEmployee[$employee['id']]['total_repayment'];
            }

            $net = $gross - $advanceDeduction;
            $totalGross += $gross;
            $totalDeductions += $advanceDeduction;

            $payrollItems[] = [
                'employee_id'       => $employee['id'],
                'gross_salary'      => $gross,
                'advance_deduction' => $advanceDeduction,
                'net_salary'        => $net,
            ];
        }

        $platformFee = $feePerEmployee * $employeeCount;
        $totalNet = $totalGross - $totalDeductions;
        $totalAmount = $totalNet + $platformFee;

        // Check company wallet balance
        $walletModel = new WalletModel();
        $companyWallet = $walletModel->getCompanyWallet($companyId);

        if (!$companyWallet || (float) $companyWallet['balance'] < $totalAmount) {
            return [
                'success'         => false,
                'message'         => 'Insufficient wallet balance',
                'required_amount' => $totalAmount,
                'available'       => $companyWallet ? (float) $companyWallet['balance'] : 0,
            ];
        }

        // Create payroll run
        $payrollId = $this->insert([
            'company_id'         => $companyId,
            'payroll_month'      => $payrollMonth,
            'pay_date'           => $payDate,
            'total_employees'    => $employeeCount,
            'total_gross_salary' => $totalGross,
            'total_deductions'   => $totalDeductions,
            'total_net_salary'   => $totalNet,
            'platform_fee'       => $platformFee,
            'total_amount'       => $totalAmount,
            'status'             => 'draft',
            'initiated_by'       => $initiatedBy,
        ]);

        // Create payroll items
        $payrollItemModel = new PayrollItemModel();
        foreach ($payrollItems as $item) {
            $item['payroll_run_id'] = $payrollId;
            $payrollItemModel->insert($item);
        }

        return [
            'success'     => true,
            'payroll_id'  => $payrollId,
            'summary'     => [
                'employees'     => $employeeCount,
                'gross_salary'  => $totalGross,
                'deductions'    => $totalDeductions,
                'net_salary'    => $totalNet,
                'platform_fee'  => $platformFee,
                'total_amount'  => $totalAmount,
            ],
        ];
    }

    /**
     * Process payroll run
     */
    public function processPayroll(int $payrollId): array
    {
        $payroll = $this->find($payrollId);
        if (!$payroll) {
            return ['success' => false, 'message' => 'Payroll not found'];
        }

        if (!in_array($payroll['status'], ['draft', 'scheduled'])) {
            return ['success' => false, 'message' => 'Payroll cannot be processed'];
        }

        $this->update($payrollId, [
            'status'       => 'processing',
            'processed_at' => date('Y-m-d H:i:s'),
        ]);

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $walletModel = new WalletModel();
            $companyWallet = $walletModel->getCompanyWallet($payroll['company_id']);

            // Debit company wallet for total amount
            $debitResult = $walletModel->debit(
                $companyWallet['id'],
                (float) $payroll['total_amount'],
                'salary_payment',
                'Payroll processing for ' . $payroll['payroll_month']
            );

            if (!$debitResult['success']) {
                throw new \Exception($debitResult['message']);
            }

            // Process each payroll item
            $payrollItemModel = new PayrollItemModel();
            $items = $payrollItemModel->where('payroll_run_id', $payrollId)->findAll();
            $advanceModel = new SalaryAdvanceModel();

            foreach ($items as $item) {
                // Get employee wallet
                $employeeWallet = $walletModel->getEmployeeWallet($item['employee_id']);
                if (!$employeeWallet) {
                    // Create employee wallet if doesn't exist
                    $walletModel->createEmployeeWallet($item['employee_id']);
                    $employeeWallet = $walletModel->getEmployeeWallet($item['employee_id']);
                }

                // Credit employee wallet
                $creditResult = $walletModel->credit(
                    $employeeWallet['id'],
                    (float) $item['net_salary'],
                    'salary_payment',
                    'Salary for ' . $payroll['payroll_month']
                );

                if ($creditResult['success']) {
                    $payrollItemModel->update($item['id'], [
                        'status'         => 'paid',
                        'transaction_id' => $creditResult['transaction_id'],
                    ]);

                    // Mark advance as repaid if applicable
                    if ((float) $item['advance_deduction'] > 0) {
                        $activeAdvances = $advanceModel->where('employee_id', $item['employee_id'])
                                                       ->where('status', 'disbursed')
                                                       ->findAll();
                        foreach ($activeAdvances as $advance) {
                            $advanceModel->markRepaid($advance['id'], $payrollId);
                        }
                    }
                } else {
                    $payrollItemModel->update($item['id'], ['status' => 'failed']);
                }
            }

            // Mark payroll as completed
            $this->update($payrollId, [
                'status'       => 'completed',
                'completed_at' => date('Y-m-d H:i:s'),
            ]);

            $db->transComplete();

            return ['success' => true, 'message' => 'Payroll processed successfully'];

        } catch (\Exception $e) {
            $db->transRollback();

            $this->update($payrollId, [
                'status'        => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Get payroll runs by company
     */
    public function getByCompany(int $companyId)
    {
        return $this->where('company_id', $companyId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get scheduled payrolls for today
     */
    public function getScheduledForToday()
    {
        return $this->where('status', 'scheduled')
                    ->where('pay_date', date('Y-m-d'))
                    ->findAll();
    }
}
