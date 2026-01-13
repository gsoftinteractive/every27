<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\WalletModel;
use App\Models\CompanyModel;
use App\Models\EmployeeModel;

class TransactionController extends BaseController
{
    protected TransactionModel $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
    }

    /**
     * List all transactions
     */
    public function index()
    {
        $type = $this->request->getGet('type');
        $status = $this->request->getGet('status');

        $builder = $this->transactionModel->builder();

        if ($type) {
            $builder->where('type', $type);
        }
        if ($status) {
            $builder->where('status', $status);
        }

        $transactions = $builder->orderBy('created_at', 'DESC')
                               ->limit(100)
                               ->get()
                               ->getResultArray();

        // Enrich transactions with wallet owner info
        $walletModel = new WalletModel();
        $companyModel = new CompanyModel();
        $employeeModel = new EmployeeModel();

        foreach ($transactions as &$transaction) {
            $wallet = $walletModel->find($transaction['wallet_id']);
            if ($wallet) {
                $transaction['wallet_type'] = $wallet['wallet_type'];
                if ($wallet['wallet_type'] === 'company') {
                    $company = $companyModel->find($wallet['company_id']);
                    $transaction['owner_name'] = $company ? $company['company_name'] : 'Unknown Company';
                } else {
                    $employee = $employeeModel->find($wallet['employee_id']);
                    $transaction['owner_name'] = $employee ? $employee['first_name'] . ' ' . $employee['last_name'] : 'Unknown Employee';
                }
            }
        }

        // Get counts by type
        $counts = [
            'total'      => $this->transactionModel->countAllResults(),
            'credit'     => $this->transactionModel->where('type', 'credit')->countAllResults(),
            'debit'      => $this->transactionModel->where('type', 'debit')->countAllResults(),
            'completed'  => $this->transactionModel->where('status', 'completed')->countAllResults(),
            'pending'    => $this->transactionModel->where('status', 'pending')->countAllResults(),
        ];

        return view('admin/transactions/index', [
            'pageTitle'     => 'Transactions',
            'userType'      => 'admin',
            'transactions'  => $transactions,
            'counts'        => $counts,
            'currentType'   => $type,
            'currentStatus' => $status,
        ]);
    }
}
