<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'       => 'Super Admin',
            'email'      => 'admin@every27.com',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'role'       => 'super_admin',
            'status'     => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('admin_users')->insert($data);

        echo "Admin user created:\n";
        echo "Email: admin@every27.com\n";
        echo "Password: admin123\n";
        echo "IMPORTANT: Change this password immediately in production!\n";
    }
}
