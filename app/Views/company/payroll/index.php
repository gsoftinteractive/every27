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
    <a href="<?= base_url('company/employees') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
        Manage Employees
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Payroll</div>
    <a href="<?= base_url('company/payroll') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        Payroll Runs
    </a>
    <a href="<?= base_url('company/advances') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        Salary Advances
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('company/wallet') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        Wallet
    </a>
    <a href="<?= base_url('company/reports') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
        Reports
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Settings</div>
    <a href="<?= base_url('company/profile') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        Company Profile
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Stats Summary -->
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-label">Active Employees</div>
        <div class="stat-value"><?= number_format($stats['active_employees']) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Monthly Payroll</div>
        <div class="stat-value">₦<?= number_format($stats['monthly_payroll'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">This Year's Total</div>
        <div class="stat-value">₦<?= number_format($stats['yearly_total'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Payroll Runs</div>
        <div class="stat-value"><?= number_format($stats['total_runs']) ?></div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payroll Runs</h3>
        <a href="<?= base_url('company/payroll/create') ?>" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Run Payroll
        </a>
    </div>
    <div class="card-body">
        <?php if (empty($payrolls)): ?>
            <div style="text-align: center; padding: 60px 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--gray-300)" stroke-width="1.5" style="margin-bottom: 16px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <h3 style="color: var(--gray-500); margin-bottom: 8px;">No Payroll Runs Yet</h3>
                <p style="color: var(--gray-400); margin-bottom: 20px;">Run your first payroll to pay your employees.</p>
                <a href="<?= base_url('company/payroll/create') ?>" class="btn btn-primary">Run Payroll</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Employees</th>
                            <th>Total Amount</th>
                            <th>Platform Fee</th>
                            <th>Status</th>
                            <th>Processed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payrolls as $payroll): ?>
                            <tr>
                                <td style="font-weight: 600;"><?= date('F Y', strtotime($payroll['payroll_month'] . '-01')) ?></td>
                                <td><?= $payroll['employee_count'] ?></td>
                                <td>₦<?= number_format($payroll['total_amount'], 2) ?></td>
                                <td style="color: var(--gray-500);">₦<?= number_format($payroll['platform_fee'], 2) ?></td>
                                <td>
                                    <span class="badge badge-<?php
                                        echo match($payroll['status']) {
                                            'pending' => 'warning',
                                            'processing' => 'info',
                                            'completed' => 'success',
                                            'failed' => 'danger',
                                            default => 'secondary'
                                        };
                                    ?>">
                                        <?= ucfirst($payroll['status']) ?>
                                    </span>
                                </td>
                                <td><?= $payroll['processed_at'] ? date('M j, Y', strtotime($payroll['processed_at'])) : '-' ?></td>
                                <td>
                                    <a href="<?= base_url('company/payroll/' . $payroll['id']) ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.875rem;">
                                        View Details
                                    </a>
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
