<?php

namespace App\Models;

use CodeIgniter\Model;

class PayrollItemModel extends Model
{
    protected $table            = 'payroll_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'payroll_run_id',
        'employee_id',
        'gross_salary',
        'bonus',
        'allowances',
        'advance_deduction',
        'other_deductions',
        'net_salary',
        'status',
        'transaction_id',
        'notes',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get items by payroll run
     */
    public function getByPayrollRun(int $payrollRunId)
    {
        return $this->select('payroll_items.*, employees.first_name, employees.last_name, employees.email, employees.employee_id as emp_id')
                    ->join('employees', 'employees.id = payroll_items.employee_id')
                    ->where('payroll_run_id', $payrollRunId)
                    ->findAll();
    }

    /**
     * Get employee payslip history
     */
    public function getEmployeePayslips(int $employeeId)
    {
        return $this->select('payroll_items.*, payroll_runs.payroll_month, payroll_runs.pay_date, payroll_runs.reference')
                    ->join('payroll_runs', 'payroll_runs.id = payroll_items.payroll_run_id')
                    ->where('payroll_items.employee_id', $employeeId)
                    ->where('payroll_items.status', 'paid')
                    ->orderBy('payroll_runs.pay_date', 'DESC')
                    ->findAll();
    }

    /**
     * Get latest payslip for employee
     */
    public function getLatestPayslip(int $employeeId): ?array
    {
        return $this->select('payroll_items.*, payroll_runs.payroll_month, payroll_runs.pay_date, payroll_runs.reference')
                    ->join('payroll_runs', 'payroll_runs.id = payroll_items.payroll_run_id')
                    ->where('payroll_items.employee_id', $employeeId)
                    ->where('payroll_items.status', 'paid')
                    ->orderBy('payroll_runs.pay_date', 'DESC')
                    ->first();
    }
}
