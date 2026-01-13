<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table            = 'companies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'company_name',
        'rc_number',
        'email',
        'password',
        'phone',
        'address',
        'industry',
        'contact_name',
        'contact_position',
        'logo',
        'cac_document',
        'verification_status',
        'verification_notes',
        'verified_at',
        'status',
        'monthly_fee_per_employee',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'company_name' => 'required|min_length[2]|max_length[255]',
        'rc_number'    => 'required|is_unique[companies.rc_number,id,{id}]',
        'email'        => 'required|valid_email|is_unique[companies.email,id,{id}]',
        'phone'        => 'required|min_length[10]',
        'contact_name' => 'required|min_length[2]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already registered.',
        ],
        'rc_number' => [
            'is_unique' => 'This RC/CAC number is already registered.',
        ],
    ];

    protected $skipValidation = false;

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Get company with wallet
     */
    public function getWithWallet(int $id): ?array
    {
        $company = $this->find($id);
        if ($company) {
            $walletModel = new WalletModel();
            $company['wallet'] = $walletModel->where('wallet_type', 'company')
                                             ->where('company_id', $id)
                                             ->first();
        }
        return $company;
    }

    /**
     * Get company employees count
     */
    public function getEmployeeCount(int $companyId): int
    {
        $employeeModel = new EmployeeModel();
        return $employeeModel->where('company_id', $companyId)
                            ->where('status', 'active')
                            ->countAllResults();
    }

    /**
     * Get verified companies
     */
    public function getVerified()
    {
        return $this->where('verification_status', 'verified')
                    ->where('status', 'active')
                    ->findAll();
    }

    /**
     * Get pending verification companies
     */
    public function getPendingVerification()
    {
        return $this->where('verification_status', 'pending')
                    ->findAll();
    }

    /**
     * Verify company
     */
    public function verify(int $id, string $notes = null): bool
    {
        return $this->update($id, [
            'verification_status' => 'verified',
            'verification_notes'  => $notes,
            'verified_at'         => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Reject company verification
     */
    public function rejectVerification(int $id, string $reason): bool
    {
        return $this->update($id, [
            'verification_status' => 'rejected',
            'verification_notes'  => $reason,
        ]);
    }
}
