<?= $this->extend('layouts/dashboard') ?>

<?php $userType = 'company'; ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('company/dashboard') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        Dashboard
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Employees</div>
    <a href="<?= base_url('company/employees') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
        Manage Employees
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Payroll</div>
    <a href="<?= base_url('company/payroll') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect></svg>
        Payroll Runs
    </a>
    <a href="<?= base_url('company/advances') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle></svg>
        Salary Advances
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('company/wallet') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect></svg>
        Wallet
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Employees</div>
        <div class="stat-value"><?= $counts['total'] ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Active</div>
        <div class="stat-value" style="color: var(--success);"><?= $counts['active'] ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Suspended</div>
        <div class="stat-value" style="color: var(--warning);"><?= $counts['suspended'] ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Terminated</div>
        <div class="stat-value" style="color: var(--danger);"><?= $counts['terminated'] ?></div>
    </div>
</div>

<!-- Actions Bar -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div style="display: flex; gap: 8px;">
        <a href="<?= base_url('company/employees') ?>" class="btn <?= !$currentStatus ? 'btn-primary' : 'btn-outline' ?>">All</a>
        <a href="<?= base_url('company/employees?status=active') ?>" class="btn <?= $currentStatus === 'active' ? 'btn-primary' : 'btn-outline' ?>">Active</a>
        <a href="<?= base_url('company/employees?status=suspended') ?>" class="btn <?= $currentStatus === 'suspended' ? 'btn-primary' : 'btn-outline' ?>">Suspended</a>
    </div>
    <a href="<?= base_url('company/employees/create') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Add Employee
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($employees)): ?>
            <div style="text-align: center; padding: 60px 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--gray-300)" stroke-width="2" style="margin-bottom: 16px;">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <h3 style="margin-bottom: 8px; color: var(--gray-600);">No employees yet</h3>
                <p style="color: var(--gray-500); margin-bottom: 20px;">Start by adding your first employee</p>
                <a href="<?= base_url('company/employees/create') ?>" class="btn btn-primary">Add Employee</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Monthly Salary</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee): ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px;">
                                            <?= strtoupper(substr($employee['first_name'], 0, 1) . substr($employee['last_name'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div style="font-weight: 500;"><?= esc($employee['first_name'] . ' ' . $employee['last_name']) ?></div>
                                            <div style="font-size: 0.75rem; color: var(--gray-500);"><?= esc($employee['employee_id']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= esc($employee['email']) ?></td>
                                <td><?= esc($employee['department'] ?: '-') ?></td>
                                <td>₦<?= number_format($employee['monthly_salary'], 2) ?></td>
                                <td>
                                    <span class="badge badge-<?= $employee['status'] === 'active' ? 'success' : ($employee['status'] === 'suspended' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($employee['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 8px;">
                                        <a href="<?= base_url('company/employees/' . $employee['id']) ?>" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.75rem;">View</a>
                                        <a href="<?= base_url('company/employees/' . $employee['id'] . '/edit') ?>" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.75rem;">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
