<?php

namespace App\Models;

use CodeIgniter\Model;

class SalaryAdvanceModel extends Model
{
    protected $table            = 'salary_advances';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'reference',
        'employee_id',
        'company_id',
        'amount_requested',
        'amount_approved',
        'fee_amount',
        'fee_percentage',
        'total_repayment',
        'monthly_salary',
        'percentage_of_salary',
        'reason',
        'status',
        'approved_by',
        'approval_notes',
        'approved_at',
        'disbursed_at',
        'repaid_at',
        'repayment_payroll_id',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $beforeInsert = ['generateReference', 'calculateFee'];

    protected function generateReference(array $data): array
    {
        if (empty($data['data']['reference'])) {
            $data['data']['reference'] = 'ADV' . date('YmdHis') . strtoupper(bin2hex(random_bytes(4)));
        }
        return $data;
    }

    protected function calculateFee(array $data): array
    {
        if (isset($data['data']['amount_requested'])) {
            $feePercentage = $data['data']['fee_percentage'] ?? 7.00;
            $amount = (float) $data['data']['amount_requested'];
            $fee = ($amount * $feePercentage) / 100;

            $data['data']['fee_amount'] = $fee;
            $data['data']['total_repayment'] = $amount + $fee;
        }
        return $data;
    }

    /**
     * Request salary advance
     */
    public function requestAdvance(int $employeeId, float $amount, string $reason = null): array
    {
        $employeeModel = new EmployeeModel();
        $canRequest = $employeeModel->canRequestAdvance($employeeId);

        if (!$canRequest['can_request']) {
            return ['success' => false, 'message' => $canRequest['reason']];
        }

        if ($amount > $canRequest['max_amount']) {
            return [
                'success' => false,
                'message' => 'Amount exceeds maximum allowed (' . number_format($canRequest['max_amount'], 2) . ')',
            ];
        }

        $employee = $employeeModel->find($employeeId);
        $percentageOfSalary = ($amount / $employee['monthly_salary']) * 100;

        $advanceId = $this->insert([
            'employee_id'          => $employeeId,
            'company_id'           => $employee['company_id'],
            'amount_requested'     => $amount,
            'monthly_salary'       => $employee['monthly_salary'],
            'percentage_of_salary' => $percentageOfSalary,
            'reason'               => $reason,
            'status'               => 'pending',
        ]);

        if ($advanceId) {
            return [
                'success'    => true,
                'advance_id' => $advanceId,
                'message'    => 'Advance request submitted successfully',
            ];
        }

        return ['success' => false, 'message' => 'Failed to submit advance request'];
    }

    /**
     * Approve advance
     */
    public function approveAdvance(int $advanceId, int $approvedBy, float $amount = null, string $notes = null): array
    {
        $advance = $this->find($advanceId);
        if (!$advance) {
            return ['success' => false, 'message' => 'Advance not found'];
        }

        if ($advance['status'] !== 'pending') {
            return ['success' => false, 'message' => 'Advance is not pending approval'];
        }

        $approvedAmount = $amount ?? $advance['amount_requested'];
        $fee = ($approvedAmount * $advance['fee_percentage']) / 100;

        $this->update($advanceId, [
            'amount_approved'  => $approvedAmount,
            'fee_amount'       => $fee,
            'total_repayment'  => $approvedAmount + $fee,
            'status'           => 'approved',
            'approved_by'      => $approvedBy,
            'approval_notes'   => $notes,
            'approved_at'      => date('Y-m-d H:i:s'),
        ]);

        return ['success' => true, 'message' => 'Advance approved successfully'];
    }

    /**
     * Reject advance
     */
    public function rejectAdvance(int $advanceId, int $rejectedBy, string $reason): array
    {
        $advance = $this->find($advanceId);
        if (!$advance) {
            return ['success' => false, 'message' => 'Advance not found'];
        }

        if ($advance['status'] !== 'pending') {
            return ['success' => false, 'message' => 'Advance is not pending approval'];
        }

        $this->update($advanceId, [
            'status'         => 'rejected',
            'approved_by'    => $rejectedBy,
            'approval_notes' => $reason,
            'approved_at'    => date('Y-m-d H:i:s'),
        ]);

        return ['success' => true, 'message' => 'Advance rejected'];
    }

    /**
     * Disburse approved advance
     */
    public function disburseAdvance(int $advanceId): array
    {
        $advance = $this->find($advanceId);
        if (!$advance) {
            return ['success' => false, 'message' => 'Advance not found'];
        }

        if ($advance['status'] !== 'approved') {
            return ['success' => false, 'message' => 'Advance must be approved first'];
        }

        // Get employee wallet
        $walletModel = new WalletModel();
        $employeeWallet = $walletModel->getEmployeeWallet($advance['employee_id']);

        if (!$employeeWallet) {
            return ['success' => false, 'message' => 'Employee wallet not found'];
        }

        // Credit employee wallet
        $result = $walletModel->credit(
            $employeeWallet['id'],
            (float) $advance['amount_approved'],
            'salary_advance',
            'Salary advance disbursement - Ref: ' . $advance['reference'],
            ['advance_id' => $advanceId]
        );

        if ($result['success']) {
            $this->update($advanceId, [
                'status'       => 'disbursed',
                'disbursed_at' => date('Y-m-d H:i:s'),
            ]);

            return ['success' => true, 'message' => 'Advance disbursed successfully'];
        }

        return $result;
    }

    /**
     * Get pending advances by company
     */
    public function getPendingByCompany(int $companyId)
    {
        return $this->where('company_id', $companyId)
                    ->where('status', 'pending')
                    ->findAll();
    }

    /**
     * Get advances by employee
     */
    public function getByEmployee(int $employeeId)
    {
        return $this->where('employee_id', $employeeId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get advances to be repaid in a payroll
     */
    public function getActiveAdvances(int $companyId)
    {
        return $this->where('company_id', $companyId)
                    ->where('status', 'disbursed')
                    ->findAll();
    }

    /**
     * Mark advance as repaid
     */
    public function markRepaid(int $advanceId, int $payrollRunId): bool
    {
        return $this->update($advanceId, [
            'status'               => 'repaid',
            'repaid_at'            => date('Y-m-d H:i:s'),
            'repayment_payroll_id' => $payrollRunId,
        ]);
    }
}
