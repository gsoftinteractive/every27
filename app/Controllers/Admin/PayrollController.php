<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PayrollRunModel;
use App\Models\PayrollItemModel;
use App\Models\CompanyModel;

class PayrollController extends BaseController
{
    protected PayrollRunModel $payrollModel;

    public function __construct()
    {
        $this->payrollModel = new PayrollRunModel();
    }

    /**
     * List all payroll runs
     */
    public function index()
    {
        $status = $this->request->getGet('status');

        $builder = $this->payrollModel->builder();
        $builder->select('payroll_runs.*, companies.company_name')
                ->join('companies', 'companies.id = payroll_runs.company_id');

        if ($status) {
            $builder->where('payroll_runs.status', $status);
        }

        $payrolls = $builder->orderBy('payroll_runs.created_at', 'DESC')
                           ->get()
                           ->getResultArray();

        $counts = [
            'total'     => $this->payrollModel->countAllResults(),
            'pending'   => $this->payrollModel->where('status', 'pending')->countAllResults(),
            'processed' => $this->payrollModel->where('status', 'processed')->countAllResults(),
            'cancelled' => $this->payrollModel->where('status', 'cancelled')->countAllResults(),
        ];

        return view('admin/payroll/index', [
            'pageTitle'     => 'Payroll Runs',
            'userType'      => 'admin',
            'payrolls'      => $payrolls,
            'counts'        => $counts,
            'currentStatus' => $status,
        ]);
    }

    /**
     * View payroll details
     */
    public function view(int $id)
    {
        $payroll = $this->payrollModel->find($id);

        if (!$payroll) {
            return redirect()->to('/admin/payroll')->with('error', 'Payroll not found');
        }

        $companyModel = new CompanyModel();
        $company = $companyModel->find($payroll['company_id']);

        $itemModel = new PayrollItemModel();
        $items = $itemModel->getByPayrollRun($id);

        return view('admin/payroll/view', [
            'pageTitle' => 'Payroll #' . $payroll['id'],
            'userType'  => 'admin',
            'payroll'   => $payroll,
            'company'   => $company,
            'items'     => $items,
        ]);
    }
}
