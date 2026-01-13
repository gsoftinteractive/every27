<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionsTable extends Migration
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
            'wallet_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['credit', 'debit'],
            ],
            'category' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'funding',           // Company funds wallet
                    'salary_payment',    // Salary to employee
                    'salary_advance',    // Advance to employee
                    'advance_repayment', // Deducted from salary
                    'withdrawal',        // Employee withdraws
                    'platform_fee',      // Monthly fee
                    'advance_fee',       // 7% advance fee
                    'refund',
                    'adjustment',
                ],
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'fee' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'balance_before' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'balance_after' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'meta' => [
                'type'    => 'JSON',
                'null'    => true,
                'comment' => 'Additional transaction data',
            ],
            'related_transaction_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'comment'    => 'For linked transactions (e.g., salary paid to employee)',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'completed', 'failed', 'reversed'],
                'default'    => 'completed',
            ],
            'processed_at' => [
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
        $this->forge->addKey('wallet_id');
        $this->forge->addKey('type');
        $this->forge->addKey('category');
        $this->forge->addKey('status');
        $this->forge->addKey('created_at');
        $this->forge->addForeignKey('wallet_id', 'wallets', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
