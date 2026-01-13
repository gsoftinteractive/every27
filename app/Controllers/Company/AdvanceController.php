<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\SalaryAdvanceModel;
use App\Models\EmployeeModel;

class AdvanceController extends BaseController
{
    protected SalaryAdvanceModel $advanceModel;
    protected int $companyId;

    public function __construct()
    {
        $this->advanceModel = new SalaryAdvanceModel();
        $this->companyId = session()->get('company_id');
    }

    /**
     * List salary advances
     */
    public function index()
    {
        $status = $this->request->getGet('status');

        $builder = $this->advanceModel->builder();
        $builder->where('company_id', $this->companyId);

        if ($status) {
            $builder->where('status', $status);
        }

        $advances = $builder->orderBy('created_at', 'DESC')->get()->getResultArray();

        // Get employee names
        $employeeModel = new EmployeeModel();
        foreach ($advances as &$advance) {
            $employee = $employeeModel->find($advance['employee_id']);
            $advance['employee_name'] = $employee ? $employee['first_name'] . ' ' . $employee['last_name'] : 'Unknown';
        }

        $counts = [
            'pending'   => $this->advanceModel->where('company_id', $this->companyId)->where('status', 'pending')->countAllResults(),
            'approved'  => $this->advanceModel->where('company_id', $this->companyId)->where('status', 'approved')->countAllResults(),
            'disbursed' => $this->advanceModel->where('company_id', $this->companyId)->where('status', 'disbursed')->countAllResults(),
        ];

        return view('company/advances/index', [
            'pageTitle'     => 'Salary Advances',
            'advances'      => $advances,
            'counts'        => $counts,
            'currentStatus' => $status,
        ]);
    }

    /**
     * View advance details
     */
    public function view(int $id)
    {
        $advance = $this->advanceModel->find($id);

        if (!$advance || $advance['company_id'] != $this->companyId) {
            return redirect()->to('/company/advances')->with('error', 'Advance not found');
        }

        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($advance['employee_id']);

        return view('company/advances/view', [
            'pageTitle' => 'Advance Request',
            'advance'   => $advance,
            'employee'  => $employee,
        ]);
    }

    /**
     * Approve advance
     */
    public function approve(int $id)
    {
        $advance = $this->advanceModel->find($id);

        if (!$advance || $advance['company_id'] != $this->companyId) {
            return redirect()->to('/company/advances')->with('error', 'Advance not found');
        }

        $amount = $this->request->getPost('amount') ?: $advance['amount_requested'];
        $notes = $this->request->getPost('notes');
        $adminId = session()->get('company_id'); // Using company as approver

        $result = $this->advanceModel->approveAdvance($id, $adminId, (float) $amount, $notes);

        if ($result['success']) {
            // Auto-disburse if checked
            if ($this->request->getPost('auto_disburse')) {
                $this->advanceModel->disburseAdvance($id);
                return redirect()->to('/company/advances')->with('success', 'Advance approved and disbursed');
            }

            return redirect()->to('/company/advances')->with('success', 'Advance approved');
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Reject advance
     */
    public function reject(int $id)
    {
        $advance = $this->advanceModel->find($id);

        if (!$advance || $advance['company_id'] != $this->companyId) {
            return redirect()->to('/company/advances')->with('error', 'Advance not found');
        }

        $reason = $this->request->getPost('reason');

        if (empty($reason)) {
            return redirect()->back()->with('error', 'Please provide a reason for rejection');
        }

        $result = $this->advanceModel->rejectAdvance($id, session()->get('company_id'), $reason);

        if ($result['success']) {
            return redirect()->to('/company/advances')->with('success', 'Advance rejected');
        }

        return redirect()->back()->with('error', $result['message']);
    }
}
