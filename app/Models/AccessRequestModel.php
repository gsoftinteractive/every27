<?php

namespace App\Models;

use CodeIgniter\Model;

class AccessRequestModel extends Model
{
    protected $table            = 'access_requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'company_name',
        'rc_number',
        'contact_name',
        'position',
        'email',
        'phone',
        'employee_count',
        'industry',
        'address',
        'message',
        'status',
        'admin_notes',
        'processed_by',
        'processed_at',
        'company_id',
        'ip_address',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'company_name'   => 'required|min_length[2]|max_length[255]',
        'rc_number'      => 'required',
        'contact_name'   => 'required|min_length[2]',
        'email'          => 'required|valid_email',
        'phone'          => 'required|min_length[10]',
        'employee_count' => 'required',
    ];

    /**
     * Get pending requests
     */
    public function getPending()
    {
        return $this->where('status', 'pending')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get requests by status
     */
    public function getByStatus(string $status)
    {
        return $this->where('status', $status)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Mark as contacted
     */
    public function markContacted(int $id, int $adminId, string $notes = null): bool
    {
        return $this->update($id, [
            'status'       => 'contacted',
            'processed_by' => $adminId,
            'admin_notes'  => $notes,
            'processed_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Approve and create company
     */
    public function approveAndCreateCompany(int $id, int $adminId, string $password): array
    {
        $request = $this->find($id);
        if (!$request) {
            return ['success' => false, 'message' => 'Request not found'];
        }

        if ($request['status'] === 'approved') {
            return ['success' => false, 'message' => 'Request already approved'];
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Create company
        $companyModel = new CompanyModel();
        $companyId = $companyModel->insert([
            'company_name'        => $request['company_name'],
            'rc_number'           => $request['rc_number'],
            'email'               => $request['email'],
            'password'            => $password,
            'phone'               => $request['phone'],
            'address'             => $request['address'],
            'industry'            => $request['industry'],
            'contact_name'        => $request['contact_name'],
            'contact_position'    => $request['position'],
            'verification_status' => 'pending',
            'status'              => 'active',
        ]);

        if (!$companyId) {
            $db->transRollback();
            return ['success' => false, 'message' => 'Failed to create company', 'errors' => $companyModel->errors()];
        }

        // Create company wallet
        $walletModel = new WalletModel();
        $walletModel->createCompanyWallet($companyId);

        // Update request
        $this->update($id, [
            'status'       => 'approved',
            'processed_by' => $adminId,
            'processed_at' => date('Y-m-d H:i:s'),
            'company_id'   => $companyId,
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return ['success' => false, 'message' => 'Transaction failed'];
        }

        return [
            'success'    => true,
            'company_id' => $companyId,
            'message'    => 'Company created successfully',
        ];
    }

    /**
     * Reject request
     */
    public function rejectRequest(int $id, int $adminId, string $reason): bool
    {
        return $this->update($id, [
            'status'       => 'rejected',
            'processed_by' => $adminId,
            'admin_notes'  => $reason,
            'processed_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Get request count by status
     */
    public function getCountByStatus(): array
    {
        $statuses = ['pending', 'contacted', 'approved', 'rejected'];
        $counts = [];

        foreach ($statuses as $status) {
            $counts[$status] = $this->where('status', $status)->countAllResults();
        }

        return $counts;
    }
}
