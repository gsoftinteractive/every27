<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePayrollRunsTable extends Migration
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
            'reference' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique'     => true,
            ],
            'company_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'payroll_month' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'comment'    => 'Format: YYYY-MM',
            ],
            'pay_date' => [
                'type' => 'DATE',
            ],
            'total_employees' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'total_gross_salary' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'total_deductions' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
                'comment'    => 'Salary advance repayments',
            ],
            'total_net_salary' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'platform_fee' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'total_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
                'comment'    => 'Total deducted from company wallet',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'scheduled', 'processing', 'completed', 'failed', 'cancelled'],
                'default'    => 'draft',
            ],
            'initiated_by' => [
                'type'       => 'ENUM',
                'constraint' => ['system', 'manual'],
                'default'    => 'system',
            ],
            'error_message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'processed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'completed_at' => [
                'type' => 'DATETIME',
                'null' => true,
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
        $this->forge->addKey('company_id');
        $this->forge->addKey('payroll_month');
        $this->forge->addKey('status');
        $this->forge->addForeignKey('company_id', 'companies', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payroll_runs');
    }

    public function down()
    {
        $this->forge->dropTable('payroll_runs');
    }
}
