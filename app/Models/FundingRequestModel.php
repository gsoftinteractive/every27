<?php

namespace App\Models;

use CodeIgniter\Model;

class FundingRequestModel extends Model
{
    protected $table            = 'funding_requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'reference',
        'company_id',
        'amount',
        'payment_method',
        'receipt_path',
        'sender_bank',
        'sender_account_name',
        'transfer_reference',
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
            $reference = 'FD' . date('Ymd') . strtoupper(bin2hex(random_bytes(4)));
        } while ($this->where('reference', $reference)->first());

        return $reference;
    }

    /**
     * Create funding request
     */
    public function createRequest(int $companyId, float $amount, array $details): array
    {
        if ($amount < 1000) {
            return ['success' => false, 'message' => 'Minimum funding amount is ₦1,000'];
        }

        $data = [
            'reference'           => $this->generateReference(),
            'company_id'          => $companyId,
            'amount'              => $amount,
            'payment_method'      => 'bank_transfer',
            'receipt_path'        => $details['receipt_path'] ?? null,
            'sender_bank'         => $details['sender_bank'] ?? null,
            'sender_account_name' => $details['sender_account_name'] ?? null,
            'transfer_reference'  => $details['transfer_reference'] ?? null,
            'status'              => 'pending',
        ];

        $this->insert($data);
        $requestId = $this->getInsertID();

        // Send email notification
        $this->sendRequestEmail($requestId);

        return ['success' => true, 'request_id' => $requestId, 'reference' => $data['reference']];
    }

    /**
     * Approve funding request and credit wallet
     */
    public function approveRequest(int $requestId, int $adminId, ?string $notes = null): array
    {
        $request = $this->find($requestId);

        if (!$request) {
            return ['success' => false, 'message' => 'Request not found'];
        }

        if ($request['status'] !== 'pending') {
            return ['success' => false, 'message' => 'Request already processed'];
        }

        $walletModel = new WalletModel();
        $wallet = $walletModel->getCompanyWallet($request['company_id']);

        if (!$wallet) {
            // Create wallet if doesn't exist
            $walletModel->createCompanyWallet($request['company_id']);
            $wallet = $walletModel->getCompanyWallet($request['company_id']);
        }

        // Credit the wallet
        $creditResult = $walletModel->credit(
            $wallet['id'],
            (float) $request['amount'],
            'funding',
            'Bank transfer funding - Ref: ' . $request['reference'],
            ['request_id' => $requestId]
        );

        if (!$creditResult['success']) {
            return $creditResult;
        }

        // Update request status
        $this->update($requestId, [
            'status'       => 'approved',
            'admin_notes'  => $notes,
            'processed_by' => $adminId,
            'processed_at' => date('Y-m-d H:i:s'),
        ]);

        // Send approval email
        $this->sendApprovalEmail($requestId);

        return ['success' => true, 'message' => 'Funding approved and wallet credited'];
    }

    /**
     * Reject funding request
     */
    public function rejectRequest(int $requestId, int $adminId, string $reason): array
    {
        $request = $this->find($requestId);

        if (!$request) {
            return ['success' => false, 'message' => 'Request not found'];
        }

        if ($request['status'] !== 'pending') {
            return ['success' => false, 'message' => 'Request already processed'];
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
            $companyModel = new CompanyModel();
            $company = $companyModel->find($request['company_id']);

            $emailService = new \App\Services\EmailService();
            $emailService->sendFundingRequestToAdmin($request, $company);
        } catch (\Exception $e) {
            log_message('error', 'Failed to send funding request email: ' . $e->getMessage());
        }
    }

    /**
     * Send approval email to company
     */
    protected function sendApprovalEmail(int $requestId): void
    {
        try {
            $request = $this->find($requestId);
            $companyModel = new CompanyModel();
            $company = $companyModel->find($request['company_id']);

            $emailService = new \App\Services\EmailService();
            $emailService->sendFundingApproved($request, $company);
        } catch (\Exception $e) {
            log_message('error', 'Failed to send funding approval email: ' . $e->getMessage());
        }
    }

    /**
     * Send rejection email to company
     */
    protected function sendRejectionEmail(int $requestId, string $reason): void
    {
        try {
            $request = $this->find($requestId);
            $companyModel = new CompanyModel();
            $company = $companyModel->find($request['company_id']);

            $emailService = new \App\Services\EmailService();
            $emailService->sendFundingRejected($request, $company);
        } catch (\Exception $e) {
            log_message('error', 'Failed to send funding rejection email: ' . $e->getMessage());
        }
    }
}
