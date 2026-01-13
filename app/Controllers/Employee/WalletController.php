<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\WalletModel;
use App\Models\TransactionModel;
use App\Models\EmployeeModel;
use App\Models\WithdrawalRequestModel;

class WalletController extends BaseController
{
    protected WalletModel $walletModel;
    protected int $employeeId;

    public function __construct()
    {
        $this->walletModel = new WalletModel();
        $this->employeeId = session()->get('employee_id');
    }

    /**
     * Wallet overview
     */
    public function index()
    {
        $wallet = $this->walletModel->getEmployeeWallet($this->employeeId);

        if (!$wallet) {
            $this->walletModel->createEmployeeWallet($this->employeeId);
            $wallet = $this->walletModel->getEmployeeWallet($this->employeeId);
        }

        $transactionModel = new TransactionModel();
        $transactions = $transactionModel->getRecent($wallet['id'], 10);

        // Get wallet stats
        $stats = [
            'total_credited'      => $transactionModel->getTotalByType($wallet['id'], 'credit'),
            'total_withdrawn'     => $transactionModel->getTotalByType($wallet['id'], 'debit'),
            'pending_withdrawals' => 0,
        ];

        // Get pending withdrawals
        $withdrawalModel = new WithdrawalRequestModel();
        $pendingWithdrawals = $withdrawalModel->where('employee_id', $this->employeeId)
                                              ->where('status', 'pending')
                                              ->findAll();
        foreach ($pendingWithdrawals as $wd) {
            $stats['pending_withdrawals'] += (float) $wd['amount'];
        }

        return view('employee/wallet/index', [
            'pageTitle'    => 'My Wallet',
            'wallet'       => $wallet,
            'transactions' => $transactions,
            'stats'        => $stats,
        ]);
    }

    /**
     * Withdraw funds form
     */
    public function withdraw()
    {
        $wallet = $this->walletModel->getEmployeeWallet($this->employeeId);
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($this->employeeId);

        // Get pending withdrawals
        $withdrawalModel = new WithdrawalRequestModel();
        $pendingWithdrawals = $withdrawalModel->where('employee_id', $this->employeeId)
                                              ->whereIn('status', ['pending', 'processing'])
                                              ->findAll();

        return view('employee/wallet/withdraw', [
            'pageTitle'          => 'Withdraw Funds',
            'wallet'             => $wallet,
            'employee'           => $employee,
            'pendingWithdrawals' => $pendingWithdrawals,
        ]);
    }

    /**
     * Process withdrawal request
     */
    public function processWithdrawal()
    {
        $amount = (float) $this->request->getPost('amount');

        if ($amount < 100) {
            return redirect()->back()->with('error', 'Minimum withdrawal amount is ₦100');
        }

        $wallet = $this->walletModel->getEmployeeWallet($this->employeeId);

        if (!$wallet) {
            return redirect()->back()->with('error', 'Wallet not found');
        }

        if ((float) $wallet['balance'] < $amount) {
            return redirect()->back()->with('error', 'Insufficient balance');
        }

        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($this->employeeId);

        if (empty($employee['bank_name']) || empty($employee['bank_account_number'])) {
            return redirect()->back()->with('error', 'Please update your bank details first');
        }

        // Create withdrawal request (admin will process manually)
        $withdrawalModel = new WithdrawalRequestModel();
        $result = $withdrawalModel->createRequest($this->employeeId, $amount, [
            'bank_name'      => $employee['bank_name'],
            'account_number' => $employee['bank_account_number'],
            'account_name'   => $employee['bank_account_name'] ?? $employee['first_name'] . ' ' . $employee['last_name'],
        ]);

        if ($result['success']) {
            return redirect()->to('/employee/wallet')
                           ->with('success', 'Withdrawal request submitted successfully. Reference: ' . $result['reference'] . '. You will be notified once processed.');
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Withdrawal history
     */
    public function withdrawals()
    {
        $withdrawalModel = new WithdrawalRequestModel();
        $withdrawals = $withdrawalModel->where('employee_id', $this->employeeId)
                                       ->orderBy('created_at', 'DESC')
                                       ->findAll();

        return view('employee/wallet/withdrawals', [
            'pageTitle'   => 'Withdrawal History',
            'withdrawals' => $withdrawals,
        ]);
    }

    /**
     * Transaction history
     */
    public function transactions()
    {
        $wallet = $this->walletModel->getEmployeeWallet($this->employeeId);

        if (!$wallet) {
            return redirect()->to('/employee/wallet')->with('error', 'Wallet not found');
        }

        $transactionModel = new TransactionModel();

        $page = (int) ($this->request->getGet('page') ?? 1);
        $limit = 20;
        $offset = ($page - 1) * $limit;

        $builder = $transactionModel->builder();
        $builder->where('wallet_id', $wallet['id']);

        $type = $this->request->getGet('type');
        if ($type) {
            $builder->where('type', $type);
        }

        $total = (clone $builder)->countAllResults(false);
        $transactions = $builder->orderBy('created_at', 'DESC')
                               ->limit($limit, $offset)
                               ->get()
                               ->getResultArray();

        return view('employee/wallet/transactions', [
            'pageTitle'    => 'Transaction History',
            'wallet'       => $wallet,
            'transactions' => $transactions,
            'pagination'   => [
                'current' => $page,
                'total'   => ceil($total / $limit),
                'perPage' => $limit,
            ],
            'filter' => $type,
        ]);
    }
}
