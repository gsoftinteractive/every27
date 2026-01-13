<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'company_id',
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'department',
        'position',
        'monthly_salary',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'date_of_birth',
        'hire_date',
        'avatar',
        'status',
        'can_request_advance',
        'max_advance_percentage',
        'last_login',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'company_id'     => 'required|is_natural_no_zero',
        'first_name'     => 'required|min_length[2]|max_length[100]',
        'last_name'      => 'required|min_length[2]|max_length[100]',
        'email'          => 'required|valid_email|is_unique[employees.email,id,{id}]',
        'monthly_salary' => 'permit_empty|decimal',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already registered.',
        ],
    ];

    protected $skipValidation = false;

    // Callbacks
    protected $beforeInsert = ['hashPassword', 'generateEmployeeId'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    protected function generateEmployeeId(array $data): array
    {
        if (empty($data['data']['employee_id']) && isset($data['data']['company_id'])) {
            $count = $this->where('company_id', $data['data']['company_id'])->countAllResults() + 1;
            $data['data']['employee_id'] = 'EMP' . str_pad($count, 5, '0', STR_PAD_LEFT);
        }
        return $data;
    }

    /**
     * Get full name
     */
    public function getFullName(array $employee): string
    {
        return $employee['first_name'] . ' ' . $employee['last_name'];
    }

    /**
     * Get employee with wallet
     */
    public function getWithWallet(int $id): ?array
    {
        $employee = $this->find($id);
        if ($employee) {
            $walletModel = new WalletModel();
            $employee['wallet'] = $walletModel->where('wallet_type', 'employee')
                                              ->where('employee_id', $id)
                                              ->first();
        }
        return $employee;
    }

    /**
     * Get employees by company
     */
    public function getByCompany(int $companyId, string $status = null)
    {
        $builder = $this->where('company_id', $companyId);
        if ($status) {
            $builder->where('status', $status);
        }
        return $builder->findAll();
    }

    /**
     * Get active employees by company
     */
    public function getActiveByCompany(int $companyId)
    {
        return $this->getByCompany($companyId, 'active');
    }

    /**
     * Check if employee can request advance
     */
    public function canRequestAdvance(int $employeeId): array
    {
        $employee = $this->find($employeeId);
        if (!$employee) {
            return ['can_request' => false, 'reason' => 'Employee not found'];
        }

        if (!$employee['can_request_advance']) {
            return ['can_request' => false, 'reason' => 'Advance requests are disabled for this employee'];
        }

        if ($employee['status'] !== 'active') {
            return ['can_request' => false, 'reason' => 'Employee is not active'];
        }

        // Check for pending advances
        $advanceModel = new SalaryAdvanceModel();
        $pendingAdvance = $advanceModel->where('employee_id', $employeeId)
                                       ->whereIn('status', ['pending', 'approved', 'disbursed'])
                                       ->first();

        if ($pendingAdvance) {
            return ['can_request' => false, 'reason' => 'You have a pending or active salary advance'];
        }

        $maxAmount = ($employee['monthly_salary'] * $employee['max_advance_percentage']) / 100;

        return [
            'can_request' => true,
            'max_amount'  => $maxAmount,
            'max_percentage' => $employee['max_advance_percentage'],
            'monthly_salary' => $employee['monthly_salary'],
        ];
    }

    /**
     * Update last login
     */
    public function updateLastLogin(int $id): bool
    {
        return $this->update($id, ['last_login' => date('Y-m-d H:i:s')]);
    }
}
