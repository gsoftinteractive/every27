<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Models\EmployeeModel;
use App\Models\WalletModel;
use App\Models\PayrollRunModel;

class CompanyController extends BaseController
{
    protected CompanyModel $companyModel;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
    }

    /**
     * List all companies
     */
    public function index()
    {
        $status = $this->request->getGet('status');
        $verification = $this->request->getGet('verification');

        $builder = $this->companyModel->builder();

        if ($status) {
            $builder->where('status', $status);
        }
        if ($verification) {
            $builder->where('verification_status', $verification);
        }

        $companies = $builder->orderBy('created_at', 'DESC')->get()->getResultArray();

        // Get employee counts for each company
        $employeeModel = new EmployeeModel();
        foreach ($companies as &$company) {
            $company['employee_count'] = $employeeModel->where('company_id', $company['id'])
                                                       ->where('status', 'active')
                                                       ->countAllResults();
        }

        // Get counts by verification status
        $counts = [
            'total'     => $this->companyModel->countAllResults(),
            'verified'  => $this->companyModel->where('verification_status', 'verified')->countAllResults(),
            'pending'   => $this->companyModel->where('verification_status', 'pending')->countAllResults(),
            'suspended' => $this->companyModel->where('status', 'suspended')->countAllResults(),
        ];

        return view('admin/companies/index', [
            'pageTitle'           => 'Companies',
            'userType'            => 'admin',
            'companies'           => $companies,
            'counts'              => $counts,
            'currentStatus'       => $status,
            'currentVerification' => $verification,
        ]);
    }

    /**
     * Show create company form
     */
    public function create()
    {
        return view('admin/companies/create', [
            'pageTitle' => 'Create Company',
            'userType'  => 'admin',
        ]);
    }

    /**
     * Store new company
     */
    public function store()
    {
        $rules = [
            'company_name'    => 'required|min_length[2]',
            'email'           => 'required|valid_email|is_unique[e27_companies.email]',
            'phone'           => 'required|min_length[10]',
            'password'        => 'required|min_length[8]',
            'contact_person'  => 'required|min_length[2]',
            'address'         => 'permit_empty',
            'industry'        => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'company_name'              => $this->request->getPost('company_name'),
            'email'                     => $this->request->getPost('email'),
            'phone'                     => $this->request->getPost('phone'),
            'password'                  => $this->request->getPost('password'), // Model will hash via callback
            'contact_name'              => $this->request->getPost('contact_person'), // Map to correct field name
            'address'                   => $this->request->getPost('address'),
            'industry'                  => $this->request->getPost('industry'),
            'status'                    => 'active',
            'verification_status'       => 'verified', // Admin-created companies are auto-verified
            'monthly_fee_per_employee'  => $this->request->getPost('monthly_fee') ?? 500,
        ];

        // Skip model validation - we already validated above
        $this->companyModel->skipValidation(true);
        $companyId = $this->companyModel->insert($data);

        if ($companyId) {
            // Create company wallet
            $walletModel = new WalletModel();
            $walletModel->createCompanyWallet($companyId);

            return redirect()->to('/admin/companies')->with('success', 'Company created successfully. Login credentials have been set.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create company');
    }

    /**
     * View company details
     */
    public function view(int $id)
    {
        $company = $this->companyModel->find($id);

        if (!$company) {
            return redirect()->to('/admin/companies')->with('error', 'Company not found');
        }

        $employeeModel = new EmployeeModel();
        $walletModel = new WalletModel();
        $payrollModel = new PayrollRunModel();

        $employees = $employeeModel->getByCompany($id);
        $wallet = $walletModel->getCompanyWallet($id);
        $payrollRuns = $payrollModel->getByCompany($id);

        $stats = [
            'total_employees'  => count($employees),
            'active_employees' => count(array_filter($employees, fn($e) => $e['status'] === 'active')),
            'wallet_balance'   => $wallet ? (float) $wallet['balance'] : 0,
            'total_payroll'    => array_sum(array_column($payrollRuns, 'total_amount')),
        ];

        return view('admin/companies/view', [
            'pageTitle'   => $company['company_name'],
            'userType'    => 'admin',
            'company'     => $company,
            'employees'   => $employees,
            'wallet'      => $wallet,
            'payrollRuns' => array_slice($payrollRuns, 0, 10),
            'stats'       => $stats,
        ]);
    }

    /**
     * Verify company
     */
    public function verify(int $id)
    {
        $notes = $this->request->getPost('notes');

        if ($this->companyModel->verify($id, $notes)) {
            // TODO: Send verification email to company
            return redirect()->back()->with('success', 'Company verified successfully');
        }

        return redirect()->back()->with('error', 'Failed to verify company');
    }

    /**
     * Reject verification
     */
    public function rejectVerification(int $id)
    {
        $reason = $this->request->getPost('reason');

        if (empty($reason)) {
            return redirect()->back()->with('error', 'Please provide a reason for rejection');
        }

        if ($this->companyModel->rejectVerification($id, $reason)) {
            return redirect()->back()->with('success', 'Verification rejected');
        }

        return redirect()->back()->with('error', 'Failed to reject verification');
    }

    /**
     * Suspend company
     */
    public function suspend(int $id)
    {
        $reason = $this->request->getPost('reason');

        if ($this->companyModel->update($id, ['status' => 'suspended'])) {
            // TODO: Log suspension reason, notify company
            return redirect()->back()->with('success', 'Company suspended');
        }

        return redirect()->back()->with('error', 'Failed to suspend company');
    }

    /**
     * Activate company
     */
    public function activate(int $id)
    {
        if ($this->companyModel->update($id, ['status' => 'active'])) {
            return redirect()->back()->with('success', 'Company activated');
        }

        return redirect()->back()->with('error', 'Failed to activate company');
    }
}
