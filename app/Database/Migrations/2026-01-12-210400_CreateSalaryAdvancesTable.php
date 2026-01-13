<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalaryAdvancesTable extends Migration
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
            'employee_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'company_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'amount_requested' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'amount_approved' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'fee_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
                'comment'    => '7% transaction fee',
            ],
            'fee_percentage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 7.00,
            ],
            'total_repayment' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'comment'    => 'amount_approved + fee_amount',
            ],
            'monthly_salary' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'comment'    => 'Employee salary at time of request',
            ],
            'percentage_of_salary' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'reason' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'disbursed', 'repaid', 'cancelled'],
                'default'    => 'pending',
            ],
            'approved_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'comment'    => 'Admin or company user who approved',
            ],
            'approval_notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'approved_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'disbursed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'repaid_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'repayment_payroll_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'comment'    => 'Payroll run when this was repaid',
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
        $this->forge->addKey('employee_id');
        $this->forge->addKey('company_id');
        $this->forge->addKey('status');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('company_id', 'companies', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('salary_advances');
    }

    public function down()
    {
        $this->forge->dropTable('salary_advances');
    }
}
