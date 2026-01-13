<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AccessRequestModel;

class AccessRequestController extends BaseController
{
    protected AccessRequestModel $requestModel;

    public function __construct()
    {
        $this->requestModel = new AccessRequestModel();
    }

    /**
     * List all access requests
     */
    public function index()
    {
        $status = $this->request->getGet('status');

        if ($status) {
            $requests = $this->requestModel->getByStatus($status);
        } else {
            $requests = $this->requestModel->orderBy('created_at', 'DESC')->findAll();
        }

        $counts = $this->requestModel->getCountByStatus();

        return view('admin/access-requests/index', [
            'pageTitle'     => 'Access Requests',
            'userType'      => 'admin',
            'requests'      => $requests,
            'counts'        => $counts,
            'currentStatus' => $status,
        ]);
    }

    /**
     * View single request
     */
    public function view(int $id)
    {
        $request = $this->requestModel->find($id);

        if (!$request) {
            return redirect()->to('/admin/access-requests')->with('error', 'Request not found');
        }

        return view('admin/access-requests/view', [
            'pageTitle' => 'Request Details',
            'userType'  => 'admin',
            'request'   => $request,
        ]);
    }

    /**
     * Mark request as contacted
     */
    public function markContacted(int $id)
    {
        $notes = $this->request->getPost('notes');
        $adminId = session()->get('admin_id');

        if ($this->requestModel->markContacted($id, $adminId, $notes)) {
            return redirect()->back()->with('success', 'Request marked as contacted');
        }

        return redirect()->back()->with('error', 'Failed to update request');
    }

    /**
     * Approve request and create company
     */
    public function approve(int $id)
    {
        $password = $this->request->getPost('password');

        if (empty($password) || strlen($password) < 8) {
            return redirect()->back()->with('error', 'Please provide a password (minimum 8 characters)');
        }

        $adminId = session()->get('admin_id');
        $result = $this->requestModel->approveAndCreateCompany($id, $adminId, $password);

        if ($result['success']) {
            // TODO: Send email with login credentials
            return redirect()->to('/admin/access-requests')->with('success', 'Company created successfully. Credentials should be sent to the company.');
        }

        $errorMessage = $result['message'];
        if (!empty($result['errors'])) {
            $errorMessage .= ': ' . implode(', ', $result['errors']);
        }

        return redirect()->back()->with('error', $errorMessage);
    }

    /**
     * Reject request
     */
    public function reject(int $id)
    {
        $reason = $this->request->getPost('reason');

        if (empty($reason)) {
            return redirect()->back()->with('error', 'Please provide a reason for rejection');
        }

        $adminId = session()->get('admin_id');

        if ($this->requestModel->rejectRequest($id, $adminId, $reason)) {
            return redirect()->to('/admin/access-requests')->with('success', 'Request rejected');
        }

        return redirect()->back()->with('error', 'Failed to reject request');
    }
}
