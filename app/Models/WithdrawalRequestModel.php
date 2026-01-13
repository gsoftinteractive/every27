<?php

namespace App\Models;

use CodeIgniter\Model;

class WithdrawalRequestModel extends Model
{
    protected $table            = 'withdrawal_requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'reference',
        'employee_id',
        'amount',
        'bank_name',
        'account_number',
        'account_name',
        'status',
        'admin_notes',
        'processed_by',
        'processed_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Generate unique reference
     */
    public function generateReference(): string
    {
        do {
            $reference = 'WD' . date('Ymd') . strtoupper(bin2hex(random_bytes(4)));
        } while ($this->where('reference', $reference)->first());

        return $reference;
    }

    /**
     * Create withdrawal request
     */
    public function createRequest(int $employeeId, float $amount, array $bankDetails): array
    {
        $walletModel = new WalletModel();
        $wallet = $walletModel->getEmployeeWallet($employeeId);

        if (!$wallet || (float) $wallet['balance'] < $amount) {
            return ['success' => false, 'message' => 'Insufficient balance'];
        }

        // Check for pending requests
        $pendingRequest = $this->where('employee_id', $employeeId)
                               ->whereIn('status', ['pending', 'processing'])
                               ->first();

        if ($pendingRequest) {
            return ['success' => false, 'message' => 'You have a pending withdrawal request'];
        }

        $data = [
            'reference'      => $this->generateReference(),
            'employee_id'    => $employeeId,
            'amount'         => $amount,
            'bank_name'      => $bankDetails['bank_name'],
            'account_number' => $bankDetails['account_number'],
            'account_name'   => $bankDetails['account_name'],
            'status'         => 'pending',
        ];

        $this->insert($data);
        $requestId = $this->getInsertID();

        // Send email notification
        $this->sendRequestEmail($requestId);

        return ['success' => true, 'request_id' => $requestId, 'reference' => $data['reference']];
    }

    /**
     * Approve and process withdrawal
     */
    public function approveRequest(int $requestId, int $adminId, ?string $notes = null): array
    {
        $request = $this->find($requestId);

        if (!$request) {
            return ['success' => false, 'message' => 'Request not found'];
        }

        if ($request['status'] !== 'pending' && $request['status'] !== 'processing') {
            return ['success' => false, 'message' => 'Request cannot be processed'];
        }

        $walletModel = new WalletModel();
        $wallet = $walletModel->getEmployeeWallet($request['employee_id']);

        if (!$wallet || (float) $wallet['balance'] < (float) $request['amount']) {
            return ['success' => false, 'message' => 'Insufficient balance in employee wallet'];
        }

        // Debit the wallet
        $debitResult = $walletModel->debit(
            $wallet['id'],
            (float) $request['amount'],
            'withdrawal',
            'Withdrawal to ' . $request['bank_name'] . ' - ' . substr($request['account_number'], -4),
            ['request_id' => $requestId]
        );

        if (!$debitResult['success']) {
            return $debitResult;
        }

        // Update request status
        $this->update($requestId, [
            'status'       => 'completed',
            'admin_notes'  => $notes,
            'processed_by' => $adminId,
            'processed_at' => date('Y-m-d H:i:s'),
        ]);

        // Send completion email
        $this->sendCompletionEmail($requestId);

        return ['success' => true, 'message' => 'Withdrawal processed successfully'];
    }

    /**
     * Reject withdrawal request
     */
    public function rejectRequest(int $requestId, int $adminId, string $reason): array
    {
        $request = $this->find($requestId);

        if (!$request) {
            return ['success' => false, 'message' => 'Request not found'];
        }

        if ($request['status'] !== 'pending' && $request['status'] !== 'processing') {
            return ['success' => false, 'message' => 'Request cannot be rejected'];
        }

        $this->update($requestId, [
            'status'       => 'rejected',
            'admin_notes'  => $reason,
            'processed_by' => $adminId,
            'processed_at' => date('Y-m-d H:i:s'),
        ]);

        // Send rejection email
        $this->sendRejectionEmail($requestId, $reason);

        return ['success' => true, 'message' => 'Request rejected'];
    }

    /**
     * Get pending requests count
     */
    public function getPendingCount(): int
    {
        return $this->where('status', 'pending')->countAllResults();
    }

    /**
     * Send request notification email to admin
     */
    protected function sendRequestEmail(int $requestId): void
    {
        try {
            $request = $this->find($requestId);
            $employeeModel = new EmployeeModel();
            $employee = $employeeModel->find($request['employee_id']);

            $emailService = new \App\Services\EmailService();
            $emailService->sendWithdrawalRequestToAdmin($request, $employee);
        } catch (\Exception $e) {
            log_message('error', 'Failed to send withdrawal request email: ' . $e->getMessage());
        }
    }

    /**
     * Send completion email to employee
     */
    protected function sendCompletionEmail(int $requestId): void
    {
        try {
            $request = $this->find($requestId);
            $employeeModel = new EmployeeModel();
            $employee = $employeeModel->find($request['employee_id']);

            $emailService = new \App\Services\EmailService();
            $emailService->sendWithdrawalCompleted($request, $employee);
        } catch (\Exception $e) {
            log_message('error', 'Failed to send withdrawal completion email: ' . $e->getMessage());
        }
    }

    /**
     * Send rejection email to employee
     */
    protected function sendRejectionEmail(int $requestId, string $reason): void
    {
        try {
            $request = $this->find($requestId);
            $employeeModel = new EmployeeModel();
            $employee = $employeeModel->find($request['employee_id']);

            $emailService = new \App\Services\EmailService();
            $emailService->sendWithdrawalRejected($request, $employee);
        } catch (\Exception $e) {
            log_message('error', 'Failed to send withdrawal rejection email: ' . $e->getMessage());
        }
    }
}
