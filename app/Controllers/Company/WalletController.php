<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\WalletModel;
use App\Models\TransactionModel;
use App\Models\CompanyModel;
use App\Models\FundingRequestModel;

class WalletController extends BaseController
{
    protected WalletModel $walletModel;
    protected int $companyId;

    public function __construct()
    {
        $this->walletModel = new WalletModel();
        $this->companyId = session()->get('company_id');
    }

    /**
     * Wallet overview
     */
    public function index()
    {
        $wallet = $this->walletModel->getCompanyWallet($this->companyId);

        if (!$wallet) {
            // Create wallet if doesn't exist
            $this->walletModel->createCompanyWallet($this->companyId);
            $wallet = $this->walletModel->getCompanyWallet($this->companyId);
        }

        $transactionModel = new TransactionModel();
        $transactions = $transactionModel->getRecent($wallet['id'], 10);

        // Calculate stats
        $stats = [
            'total_funded' => $transactionModel->getTotalByType($wallet['id'], 'credit', 'funding'),
            'total_disbursed' => $transactionModel->getTotalByType($wallet['id'], 'debit'),
            'monthly_payroll' => $transactionModel->getMonthlyPayroll($wallet['id']),
        ];

        return view('company/wallet/index', [
            'pageTitle'    => 'Wallet',
            'wallet'       => $wallet,
            'transactions' => $transactions,
            'stats'        => $stats,
        ]);
    }

    /**
     * Fund wallet form
     */
    public function fund()
    {
        $wallet = $this->walletModel->getCompanyWallet($this->companyId);
        $companyModel = new CompanyModel();
        $company = $companyModel->find($this->companyId);

        // Get pending funding requests
        $fundingModel = new FundingRequestModel();
        $pendingFundings = $fundingModel->where('company_id', $this->companyId)
                                        ->whereIn('status', ['pending', 'processing'])
                                        ->findAll();

        // Platform bank account details for transfer
        $platformBankDetails = [
            'bank_name'      => 'Zenith Bank',
            'account_number' => '1234567890',
            'account_name'   => 'Every27 Technologies Limited',
        ];

        return view('company/wallet/fund', [
            'pageTitle'           => 'Fund Wallet',
            'wallet'              => $wallet,
            'company'             => $company,
            'pendingFundings'     => $pendingFundings,
            'platformBankDetails' => $platformBankDetails,
        ]);
    }

    /**
     * Process wallet funding - creates funding request with receipt upload
     */
    public function processFunding()
    {
        $amount = (float) $this->request->getPost('amount');
        $senderBank = $this->request->getPost('sender_bank');
        $senderAccountName = $this->request->getPost('sender_account_name');
        $transferReference = $this->request->getPost('transfer_reference');

        // Validation
        if ($amount < 1000) {
            return redirect()->back()->with('error', 'Minimum funding amount is ₦1,000');
        }

        if (empty($senderBank) || empty($senderAccountName)) {
            return redirect()->back()->with('error', 'Please provide your bank name and account name');
        }

        // Handle receipt upload
        $receipt = $this->request->getFile('receipt');
        if (!$receipt || !$receipt->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid payment receipt');
        }

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
        if (!in_array($receipt->getMimeType(), $allowedTypes)) {
            return redirect()->back()->with('error', 'Receipt must be an image (JPG, PNG, GIF) or PDF');
        }

        // Validate file size (max 5MB)
        if ($receipt->getSize() > 5 * 1024 * 1024) {
            return redirect()->back()->with('error', 'Receipt file size must not exceed 5MB');
        }

        // Save receipt file
        $receiptName = $receipt->getRandomName();
        $receipt->move(WRITEPATH . 'uploads/receipts', $receiptName);
        $receiptPath = 'uploads/receipts/' . $receiptName;

        // Create funding request
        $fundingModel = new FundingRequestModel();
        $result = $fundingModel->createRequest($this->companyId, $amount, [
            'payment_method'      => 'bank_transfer',
            'receipt_path'        => $receiptPath,
            'sender_bank'         => $senderBank,
            'sender_account_name' => $senderAccountName,
            'transfer_reference'  => $transferReference,
        ]);

        if ($result['success']) {
            return redirect()->to('/company/wallet')
                           ->with('success', 'Funding request submitted successfully. Reference: ' . $result['reference'] . '. Your wallet will be credited once the payment is verified.');
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Funding history
     */
    public function fundings()
    {
        $fundingModel = new FundingRequestModel();
        $fundings = $fundingModel->where('company_id', $this->companyId)
                                 ->orderBy('created_at', 'DESC')
                                 ->findAll();

        return view('company/wallet/fundings', [
            'pageTitle' => 'Funding History',
            'fundings'  => $fundings,
        ]);
    }

    /**
     * Transaction history
     */
    public function transactions()
    {
        $wallet = $this->walletModel->getCompanyWallet($this->companyId);

        if (!$wallet) {
            return redirect()->to('/company/wallet')->with('error', 'Wallet not found');
        }

        $transactionModel = new TransactionModel();

        $page = (int) ($this->request->getGet('page') ?? 1);
        $limit = 20;
        $offset = ($page - 1) * $limit;

        // Filters
        $type = $this->request->getGet('type');
        $category = $this->request->getGet('category');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $builder = $transactionModel->builder();
        $builder->where('wallet_id', $wallet['id']);

        if ($type) {
            $builder->where('type', $type);
        }
        if ($category) {
            $builder->where('category', $category);
        }
        if ($startDate) {
            $builder->where('created_at >=', $startDate . ' 00:00:00');
        }
        if ($endDate) {
            $builder->where('created_at <=', $endDate . ' 23:59:59');
        }

        $total = (clone $builder)->countAllResults(false);
        $transactions = $builder->orderBy('created_at', 'DESC')
                               ->limit($limit, $offset)
                               ->get()
                               ->getResultArray();

        return view('company/wallet/transactions', [
            'pageTitle'    => 'Transactions',
            'wallet'       => $wallet,
            'transactions' => $transactions,
            'pagination'   => [
                'current'  => $page,
                'total'    => ceil($total / $limit),
                'perPage'  => $limit,
                'totalRecords' => $total,
            ],
            'filters' => [
                'type'       => $type,
                'category'   => $category,
                'start_date' => $startDate,
                'end_date'   => $endDate,
            ],
        ]);
    }
}
