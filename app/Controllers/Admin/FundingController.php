<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FundingRequestModel;
use App\Models\CompanyModel;

class FundingController extends BaseController
{
    protected FundingRequestModel $fundingModel;

    public function __construct()
    {
        $this->fundingModel = new FundingRequestModel();
    }

    /**
     * List all funding requests
     */
    public function index()
    {
        $status = $this->request->getGet('status');

        $builder = $this->fundingModel->builder();
        $builder->select('funding_requests.*, companies.company_name, companies.email as company_email')
                ->join('companies', 'companies.id = funding_requests.company_id');

        if ($status) {
            $builder->where('funding_requests.status', $status);
        }

        $fundings = $builder->orderBy('funding_requests.created_at', 'DESC')
                           ->get()
                           ->getResultArray();

        // Get counts by status
        $counts = [
            'pending'    => $this->fundingModel->where('status', 'pending')->countAllResults(),
            'processing' => $this->fundingModel->where('status', 'processing')->countAllResults(),
            'approved'   => $this->fundingModel->where('status', 'approved')->countAllResults(),
            'rejected'   => $this->fundingModel->where('status', 'rejected')->countAllResults(),
        ];

        return view('admin/fundings/index', [
            'pageTitle' => 'Funding Requests',
            'userType'  => 'admin',
            'fundings'  => $fundings,
            'counts'    => $counts,
            'filter'    => $status,
        ]);
    }

    /**
     * View funding request details
     */
    public function view($id)
    {
        $funding = $this->fundingModel->find($id);

        if (!$funding) {
            return redirect()->to('/admin/fundings')->with('error', 'Funding request not found');
        }

        $companyModel = new CompanyModel();
        $company = $companyModel->find($funding['company_id']);

        return view('admin/fundings/view', [
            'pageTitle' => 'Funding Request #' . $funding['reference'],
            'userType'  => 'admin',
            'funding'   => $funding,
            'company'   => $company,
        ]);
    }

    /**
     * View receipt image/file
     */
    public function viewReceipt($id)
    {
        $funding = $this->fundingModel->find($id);

        if (!$funding || empty($funding['receipt_path'])) {
            return redirect()->back()->with('error', 'Receipt not found');
        }

        $filePath = WRITEPATH . $funding['receipt_path'];

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Receipt file not found');
        }

        $mimeType = mime_content_type($filePath);

        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="receipt-' . $funding['reference'] . '"')
            ->setBody(file_get_contents($filePath));
    }

    /**
     * Approve funding request and credit company wallet
     */
    public function approve($id)
    {
        $funding = $this->fundingModel->find($id);

        if (!$funding) {
            return redirect()->to('/admin/fundings')->with('error', 'Funding request not found');
        }

        if ($funding['status'] !== 'pending' && $funding['status'] !== 'processing') {
            return redirect()->back()->with('error', 'This funding request cannot be approved');
        }

        $adminId = session()->get('admin_id');
        $notes = $this->request->getPost('notes');

        $result = $this->fundingModel->approveRequest($id, $adminId, $notes);

        if ($result['success']) {
            return redirect()->to('/admin/fundings')
                           ->with('success', 'Funding request approved. Company wallet has been credited with NGN ' . number_format($funding['amount'], 2));
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Reject funding request
     */
    public function reject($id)
    {
        $funding = $this->fundingModel->find($id);

        if (!$funding) {
            return redirect()->to('/admin/fundings')->with('error', 'Funding request not found');
        }

        if ($funding['status'] !== 'pending' && $funding['status'] !== 'processing') {
            return redirect()->back()->with('error', 'This funding request cannot be rejected');
        }

        $adminId = session()->get('admin_id');
        $reason = $this->request->getPost('reason');

        if (empty($reason)) {
            return redirect()->back()->with('error', 'Please provide a reason for rejection');
        }

        $result = $this->fundingModel->rejectRequest($id, $adminId, $reason);

        if ($result['success']) {
            return redirect()->to('/admin/fundings')
                           ->with('success', 'Funding request rejected successfully.');
        }

        return redirect()->back()->with('error', $result['message']);
    }
}
