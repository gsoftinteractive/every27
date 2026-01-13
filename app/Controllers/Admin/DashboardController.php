<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Models\EmployeeModel;
use App\Models\AccessRequestModel;
use App\Models\TransactionModel;
use App\Models\SalaryAdvanceModel;

class DashboardController extends BaseController
{
    /**
     * Admin Dashboard
     */
    public function index()
    {
        $companyModel       = new CompanyModel();
        $employeeModel      = new EmployeeModel();
        $accessRequestModel = new AccessRequestModel();
        $transactionModel   = new TransactionModel();
        $advanceModel       = new SalaryAdvanceModel();

        // Statistics
        $stats = [
            'total_companies'     => $companyModel->countAllResults(),
            'verified_companies'  => $companyModel->where('verification_status', 'verified')->countAllResults(),
            'pending_companies'   => $companyModel->where('verification_status', 'pending')->countAllResults(),
            'total_employees'     => $employeeModel->countAllResults(),
            'active_employees'    => $employeeModel->where('status', 'active')->countAllResults(),
            'pending_requests'    => $accessRequestModel->where('status', 'pending')->countAllResults(),
            'pending_advances'    => $advanceModel->where('status', 'pending')->countAllResults(),
        ];

        // Platform metrics
        $platformStats = $transactionModel->getPlatformStats('month');

        // Recent access requests
        $recentRequests = $accessRequestModel->orderBy('created_at', 'DESC')->findAll(5);

        // Recent companies pending verification
        $pendingVerification = $companyModel->where('verification_status', 'pending')
                                           ->orderBy('created_at', 'DESC')
                                           ->findAll(5);

        // Recent transactions
        $recentTransactions = $transactionModel->orderBy('created_at', 'DESC')
                                               ->findAll(10);

        return view('admin/dashboard', [
            'pageTitle'           => 'Admin Dashboard',
            'userType'            => 'admin',
            'stats'               => $stats,
            'platformStats'       => $platformStats,
            'recentRequests'      => $recentRequests,
            'pendingVerification' => $pendingVerification,
            'recentTransactions'  => $recentTransactions,
        ]);
    }
}
