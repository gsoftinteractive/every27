<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\SalaryAdvanceModel;
use App\Models\EmployeeModel;

class AdvanceController extends BaseController
{
    protected SalaryAdvanceModel $advanceModel;
    protected int $employeeId;

    public function __construct()
    {
        $this->advanceModel = new SalaryAdvanceModel();
        $this->employeeId = session()->get('employee_id');
    }

    /**
     * List my advances
     */
    public function index()
    {
        $advances = $this->advanceModel->getByEmployee($this->employeeId);

        $employeeModel = new EmployeeModel();
        $eligibility = $employeeModel->canRequestAdvance($this->employeeId);

        return view('employee/advance/index', [
            'pageTitle'   => 'Salary Advance',
            'advances'    => $advances,
            'eligibility' => $eligibility,
        ]);
    }

    /**
     * Request advance form
     */
    public function request()
    {
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($this->employeeId);
        $eligibility = $employeeModel->canRequestAdvance($this->employeeId);

        if (!$eligibility['can_request']) {
            return redirect()->to('/employee/advance')->with('error', $eligibility['reason']);
        }

        return view('employee/advance/request', [
            'pageTitle'   => 'Request Salary Advance',
            'employee'    => $employee,
            'eligibility' => $eligibility,
        ]);
    }

    /**
     * Submit advance request
     */
    public function submitRequest()
    {
        $amount = (float) $this->request->getPost('amount');
        $reason = $this->request->getPost('reason');

        if ($amount < 1000) {
            return redirect()->back()->withInput()->with('error', 'Minimum advance amount is ₦1,000');
        }

        $result = $this->advanceModel->requestAdvance($this->employeeId, $amount, $reason);

        if ($result['success']) {
            // Calculate fee for display
            $fee = $amount * 0.07;
            $totalRepayment = $amount + $fee;

            return redirect()->to('/employee/advance')
                           ->with('success', 'Advance request submitted! Amount: ₦' . number_format($amount, 2) . '. Total repayment: ₦' . number_format($totalRepayment, 2) . ' (includes 7% fee)');
        }

        return redirect()->back()->withInput()->with('error', $result['message']);
    }

    /**
     * View advance details
     */
    public function view(int $id)
    {
        $advance = $this->advanceModel->find($id);

        if (!$advance || $advance['employee_id'] != $this->employeeId) {
            return redirect()->to('/employee/advance')->with('error', 'Advance not found');
        }

        return view('employee/advance/view', [
            'pageTitle' => 'Advance Details',
            'advance'   => $advance,
        ]);
    }
}
