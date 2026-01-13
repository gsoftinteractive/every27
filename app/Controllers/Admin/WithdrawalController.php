<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WithdrawalRequestModel;
use App\Models\EmployeeModel;
use App\Models\CompanyModel;

class WithdrawalController extends BaseController
{
    protected WithdrawalRequestModel $withdrawalModel;

    public function __construct()
    {
        $this->withdrawalModel = new WithdrawalRequestModel();
    }

    /**
     * List all withdrawal requests
     */
    public function index()
    {
        $status = $this->request->getGet('status');

        $builder = $this->withdrawalModel->builder();
        $builder->select('withdrawal_requests.*, employees.first_name, employees.last_name, employees.email as employee_email, companies.company_name')
                ->join('employees', 'employees.id = withdrawal_requests.employee_id')
                ->join('companies', 'companies.id = employees.company_id');

        if ($status) {
            $builder->where('withdrawal_requests.status', $status);
        }

        $withdrawals = $builder->orderBy('withdrawal_requests.created_at', 'DESC')
                              ->get()
                              ->getResultArray();

        // Get counts by status
        $counts = [
            'pending'    => $this->withdrawalModel->where('status', 'pending')->countAllResults(),
            'processing' => $this->withdrawalModel->where('status', 'processing')->countAllResults(),
            'completed'  => $this->withdrawalModel->where('status', 'completed')->countAllResults(),
            'rejected'   => $this->withdrawalModel->where('status', 'rejected')->countAllResults(),
        ];

        return view('admin/withdrawals/index', [
            'pageTitle'   => 'Withdrawal Requests',
            'userType'    => 'admin',
            'withdrawals' => $withdrawals,
            'counts'      => $counts,
            'filter'      => $status,
        ]);
    }

    /**
     * View withdrawal request details
     */
    public function view($id)
    {
        $withdrawal = $this->withdrawalModel->find($id);

        if (!$withdrawal) {
            return redirect()->to('/admin/withdrawals')->with('error', 'Withdrawal request not found');
        }

        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($withdrawal['employee_id']);

        $companyModel = new CompanyModel();
        $company = $companyModel->find($employee['company_id']);

        return view('admin/withdrawals/view', [
            'pageTitle'  => 'Withdrawal Request #' . $withdrawal['reference'],
            'userType'   => 'admin',
            'withdrawal' => $withdrawal,
            'employee'   => $employee,
            'company'    => $company,
        ]);
    }

    /**
     * Approve and process withdrawal request
     */
    public function approve($id)
    {
        $withdrawal = $this->withdrawalModel->find($id);

        if (!$withdrawal) {
            return redirect()->to('/admin/withdrawals')->with('error', 'Withdrawal request not found');
        }

        if ($withdrawal['status'] !== 'pending' && $withdrawal['status'] !== 'processing') {
            return redirect()->back()->with('error', 'This withdrawal request cannot be approved');
        }

        $adminId = session()->get('admin_id');
        $notes = $this->request->getPost('notes');

        $result = $this->withdrawalModel->approveRequest($id, $adminId, $notes);

        if ($result['success']) {
            return redirect()->to('/admin/withdrawals')
                           ->with('success', 'Withdrawal approved and processed successfully. Employee wallet has been debited.');
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Reject withdrawal request
     */
    public function reject($id)
    {
        $withdrawal = $this->withdrawalModel->find($id);

        if (!$withdrawal) {
            return redirect()->to('/admin/withdrawals')->with('error', 'Withdrawal request not found');
        }

        if ($withdrawal['status'] !== 'pending' && $withdrawal['status'] !== 'processing') {
            return redirect()->back()->with('error', 'This withdrawal request cannot be rejected');
        }

        $adminId = session()->get('admin_id');
        $reason = $this->request->getPost('reason');

        if (empty($reason)) {
            return redirect()->back()->with('error', 'Please provide a reason for rejection');
        }

        $result = $this->withdrawalModel->rejectRequest($id, $adminId, $reason);

        if ($result['success']) {
            return redirect()->to('/admin/withdrawals')
                           ->with('success', 'Withdrawal request rejected successfully.');
        }

        return redirect()->back()->with('error', $result['message']);
    }
}
