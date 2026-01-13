<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    protected $table            = 'wallets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'wallet_type',
        'company_id',
        'employee_id',
        'balance',
        'ledger_balance',
        'currency',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Create company wallet
     */
    public function createCompanyWallet(int $companyId): int|false
    {
        return $this->insert([
            'wallet_type' => 'company',
            'company_id'  => $companyId,
            'balance'     => 0,
            'ledger_balance' => 0,
            'currency'    => 'NGN',
            'status'      => 'active',
        ]);
    }

    /**
     * Create employee wallet
     */
    public function createEmployeeWallet(int $employeeId): int|false
    {
        return $this->insert([
            'wallet_type' => 'employee',
            'employee_id' => $employeeId,
            'balance'     => 0,
            'ledger_balance' => 0,
            'currency'    => 'NGN',
            'status'      => 'active',
        ]);
    }

    /**
     * Get company wallet
     */
    public function getCompanyWallet(int $companyId): ?array
    {
        return $this->where('wallet_type', 'company')
                    ->where('company_id', $companyId)
                    ->first();
    }

    /**
     * Get employee wallet
     */
    public function getEmployeeWallet(int $employeeId): ?array
    {
        return $this->where('wallet_type', 'employee')
                    ->where('employee_id', $employeeId)
                    ->first();
    }

    /**
     * Credit wallet
     */
    public function credit(int $walletId, float $amount, string $category, string $description = null, array $meta = null): array
    {
        $wallet = $this->find($walletId);
        if (!$wallet) {
            return ['success' => false, 'message' => 'Wallet not found'];
        }

        if ($wallet['status'] !== 'active') {
            return ['success' => false, 'message' => 'Wallet is not active'];
        }

        $balanceBefore = (float) $wallet['balance'];
        $balanceAfter  = $balanceBefore + $amount;

        // Update wallet balance
        $this->update($walletId, [
            'balance'        => $balanceAfter,
            'ledger_balance' => $balanceAfter,
        ]);

        // Create transaction record
        $transactionModel = new TransactionModel();
        $transactionId = $transactionModel->insert([
            'reference'      => $transactionModel->generateReference(),
            'wallet_id'      => $walletId,
            'type'           => 'credit',
            'category'       => $category,
            'amount'         => $amount,
            'balance_before' => $balanceBefore,
            'balance_after'  => $balanceAfter,
            'description'    => $description,
            'meta'           => $meta ? json_encode($meta) : null,
            'status'         => 'completed',
            'processed_at'   => date('Y-m-d H:i:s'),
        ]);

        return [
            'success'        => true,
            'transaction_id' => $transactionId,
            'balance'        => $balanceAfter,
        ];
    }

    /**
     * Debit wallet
     */
    public function debit(int $walletId, float $amount, string $category, string $description = null, array $meta = null): array
    {
        $wallet = $this->find($walletId);
        if (!$wallet) {
            return ['success' => false, 'message' => 'Wallet not found'];
        }

        if ($wallet['status'] !== 'active') {
            return ['success' => false, 'message' => 'Wallet is not active'];
        }

        $balanceBefore = (float) $wallet['balance'];
        if ($balanceBefore < $amount) {
            return ['success' => false, 'message' => 'Insufficient balance'];
        }

        $balanceAfter = $balanceBefore - $amount;

        // Update wallet balance
        $this->update($walletId, [
            'balance'        => $balanceAfter,
            'ledger_balance' => $balanceAfter,
        ]);

        // Create transaction record
        $transactionModel = new TransactionModel();
        $transactionId = $transactionModel->insert([
            'reference'      => $transactionModel->generateReference(),
            'wallet_id'      => $walletId,
            'type'           => 'debit',
            'category'       => $category,
            'amount'         => $amount,
            'balance_before' => $balanceBefore,
            'balance_after'  => $balanceAfter,
            'description'    => $description,
            'meta'           => $meta ? json_encode($meta) : null,
            'status'         => 'completed',
            'processed_at'   => date('Y-m-d H:i:s'),
        ]);

        return [
            'success'        => true,
            'transaction_id' => $transactionId,
            'balance'        => $balanceAfter,
        ];
    }

    /**
     * Transfer between wallets
     */
    public function transfer(int $fromWalletId, int $toWalletId, float $amount, string $category, string $description = null): array
    {
        $db = \Config\Database::connect();
        $db->transStart();

        // Debit from source wallet
        $debitResult = $this->debit($fromWalletId, $amount, $category, $description);
        if (!$debitResult['success']) {
            $db->transRollback();
            return $debitResult;
        }

        // Credit to destination wallet
        $creditResult = $this->credit($toWalletId, $amount, $category, $description);
        if (!$creditResult['success']) {
            $db->transRollback();
            return $creditResult;
        }

        // Link transactions
        $transactionModel = new TransactionModel();
        $transactionModel->update($creditResult['transaction_id'], [
            'related_transaction_id' => $debitResult['transaction_id'],
        ]);
        $transactionModel->update($debitResult['transaction_id'], [
            'related_transaction_id' => $creditResult['transaction_id'],
        ]);

        $db->transComplete();

        return [
            'success'              => true,
            'debit_transaction_id' => $debitResult['transaction_id'],
            'credit_transaction_id' => $creditResult['transaction_id'],
        ];
    }
}
