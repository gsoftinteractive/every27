<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'reference',
        'wallet_id',
        'type',
        'category',
        'amount',
        'fee',
        'balance_before',
        'balance_after',
        'description',
        'meta',
        'related_transaction_id',
        'status',
        'processed_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Generate unique transaction reference
     */
    public function generateReference(): string
    {
        $prefix = 'TXN';
        $timestamp = date('YmdHis');
        $random = strtoupper(bin2hex(random_bytes(4)));
        return $prefix . $timestamp . $random;
    }

    /**
     * Get transactions by wallet
     */
    public function getByWallet(int $walletId, int $limit = 50, int $offset = 0)
    {
        return $this->where('wallet_id', $walletId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get transactions by category
     */
    public function getByCategory(int $walletId, string $category)
    {
        return $this->where('wallet_id', $walletId)
                    ->where('category', $category)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get transaction by reference
     */
    public function getByReference(string $reference): ?array
    {
        return $this->where('reference', $reference)->first();
    }

    /**
     * Get transaction summary for wallet
     */
    public function getWalletSummary(int $walletId, string $startDate = null, string $endDate = null): array
    {
        $builder = $this->db->table($this->table);
        $builder->where('wallet_id', $walletId);
        $builder->where('status', 'completed');

        if ($startDate) {
            $builder->where('created_at >=', $startDate);
        }
        if ($endDate) {
            $builder->where('created_at <=', $endDate);
        }

        $credits = (clone $builder)->where('type', 'credit')
                                   ->selectSum('amount')
                                   ->get()
                                   ->getRow();

        $debits = (clone $builder)->where('type', 'debit')
                                  ->selectSum('amount')
                                  ->get()
                                  ->getRow();

        return [
            'total_credits' => (float) ($credits->amount ?? 0),
            'total_debits'  => (float) ($debits->amount ?? 0),
        ];
    }

    /**
     * Get transactions for date range
     */
    public function getByDateRange(int $walletId, string $startDate, string $endDate)
    {
        return $this->where('wallet_id', $walletId)
                    ->where('created_at >=', $startDate)
                    ->where('created_at <=', $endDate)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get recent transactions
     */
    public function getRecent(int $walletId, int $count = 10)
    {
        return $this->where('wallet_id', $walletId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($count);
    }

    /**
     * Get all platform transactions (admin)
     */
    public function getAllTransactions(int $limit = 100, int $offset = 0, array $filters = [])
    {
        $builder = $this->builder();

        if (!empty($filters['category'])) {
            $builder->where('category', $filters['category']);
        }
        if (!empty($filters['type'])) {
            $builder->where('type', $filters['type']);
        }
        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }
        if (!empty($filters['start_date'])) {
            $builder->where('created_at >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $builder->where('created_at <=', $filters['end_date']);
        }

        return $builder->orderBy('created_at', 'DESC')
                       ->limit($limit, $offset)
                       ->get()
                       ->getResultArray();
    }

    /**
     * Get platform statistics
     */
    public function getPlatformStats(string $period = 'month'): array
    {
        $startDate = match ($period) {
            'today' => date('Y-m-d 00:00:00'),
            'week'  => date('Y-m-d 00:00:00', strtotime('-7 days')),
            'month' => date('Y-m-01 00:00:00'),
            'year'  => date('Y-01-01 00:00:00'),
            default => date('Y-m-01 00:00:00'),
        };

        $builder = $this->db->table($this->table);
        $builder->where('status', 'completed');
        $builder->where('created_at >=', $startDate);

        $totalVolume = (clone $builder)->selectSum('amount')->get()->getRow();
        $totalFees = (clone $builder)->selectSum('fee')->get()->getRow();
        $txnCount = (clone $builder)->selectCount('id')->get()->getRow();

        return [
            'total_volume'    => (float) ($totalVolume->amount ?? 0),
            'total_fees'      => (float) ($totalFees->fee ?? 0),
            'transaction_count' => (int) ($txnCount->id ?? 0),
            'period'          => $period,
        ];
    }
}
