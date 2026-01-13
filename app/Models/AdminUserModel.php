<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table            = 'admin_users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'status',
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
        'name'  => 'required|min_length[2]|max_length[255]',
        'email' => 'required|valid_email|is_unique[admin_users.email,id,{id}]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already registered.',
        ],
    ];

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
     * Authenticate admin user
     */
    public function authenticate(string $email, string $password): ?array
    {
        $admin = $this->where('email', $email)
                     ->where('status', 'active')
                     ->first();

        if ($admin && password_verify($password, $admin['password'])) {
            $this->updateLastLogin($admin['id']);
            unset($admin['password']);
            return $admin;
        }

        return null;
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin(int $id): bool
    {
        return $this->update($id, ['last_login' => date('Y-m-d H:i:s')]);
    }

    /**
     * Get admin by email
     */
    public function getByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Check if admin has role
     */
    public function hasRole(int $adminId, string $role): bool
    {
        $admin = $this->find($adminId);
        return $admin && $admin['role'] === $role;
    }

    /**
     * Check if admin is super admin
     */
    public function isSuperAdmin(int $adminId): bool
    {
        return $this->hasRole($adminId, 'super_admin');
    }

    /**
     * Get all admins by role
     */
    public function getByRole(string $role)
    {
        return $this->where('role', $role)->findAll();
    }
}
