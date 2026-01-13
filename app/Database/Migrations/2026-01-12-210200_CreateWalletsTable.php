<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWalletsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'wallet_type' => [
                'type'       => 'ENUM',
                'constraint' => ['company', 'employee'],
            ],
            'company_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'employee_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'balance' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'ledger_balance' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
                'comment'    => 'Balance including pending transactions',
            ],
            'currency' => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
                'default'    => 'NGN',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'frozen', 'closed'],
                'default'    => 'active',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('wallet_type');
        $this->forge->addKey('company_id');
        $this->forge->addKey('employee_id');
        $this->forge->addForeignKey('company_id', 'companies', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('wallets');
    }

    public function down()
    {
        $this->forge->dropTable('wallets');
    }
}
