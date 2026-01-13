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
<a href="<?= base_url('company/payroll') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Payroll
</a>

<!-- Payroll Header -->
<div class="card" style="background: linear-gradient(135deg, var(--primary) 0%, #0b6bc5 100%); color: white; margin-bottom: 24px;">
    <div class="card-body">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="margin: 0; font-size: 1.5rem;"><?= date('F Y', strtotime($payroll['payroll_month'] . '-01')) ?> Payroll</h2>
                <p style="margin: 8px 0 0; opacity: 0.9;">
                    Processed on <?= $payroll['processed_at'] ? date('M j, Y', strtotime($payroll['processed_at'])) : 'Not yet processed' ?>
                </p>
            </div>
            <span class="badge" style="background: rgba(255,255,255,0.2); color: white; padding: 8px 16px; font-size: 1rem;">
                <?= ucfirst($payroll['status']) ?>
            </span>
        </div>
    </div>
</div>

<!-- Summary Stats -->
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-label">Employees Paid</div>
        <div class="stat-value"><?= $payroll['employee_count'] ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Gross</div>
        <div class="stat-value">₦<?= number_format($payroll['total_amount'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Deductions</div>
        <div class="stat-value" style="color: var(--danger);">₦<?= number_format($payroll['total_deductions'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Platform Fee</div>
        <div class="stat-value" style="color: var(--primary);">₦<?= number_format($payroll['platform_fee'], 2) ?></div>
    </div>
</div>

<!-- Payroll Items -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payment Details</h3>
    </div>
    <div class="card-body">
        <?php if (empty($items)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No payment details available.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Gross Salary</th>
                            <th>Advance Deduction</th>
                            <th>Other Deductions</th>
                            <th>Net Salary</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <div style="font-weight: 600;"><?= esc($item['employee_name']) ?></div>
                                    <div style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($item['position'] ?: '-') ?></div>
                                </td>
                                <td>₦<?= number_format($item['gross_salary'], 2) ?></td>
                                <td style="color: <?= $item['advance_deduction'] > 0 ? 'var(--danger)' : 'var(--gray-400)' ?>;">
                                    <?= $item['advance_deduction'] > 0 ? '-₦' . number_format($item['advance_deduction'], 2) : '-' ?>
                                </td>
                                <td style="color: <?= $item['total_deductions'] - $item['advance_deduction'] > 0 ? 'var(--danger)' : 'var(--gray-400)' ?>;">
                                    <?= ($item['total_deductions'] - $item['advance_deduction']) > 0 ? '-₦' . number_format($item['total_deductions'] - $item['advance_deduction'], 2) : '-' ?>
                                </td>
                                <td style="font-weight: 600; color: var(--success);">₦<?= number_format($item['net_salary'], 2) ?></td>
                                <td>
                                    <span class="badge badge-<?= $item['status'] === 'paid' ? 'success' : ($item['status'] === 'failed' ? 'danger' : 'warning') ?>">
                                        <?= ucfirst($item['status']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot style="font-weight: 600; background: var(--gray-50);">
                        <tr>
                            <td>Total</td>
                            <td>₦<?= number_format(array_sum(array_column($items, 'gross_salary')), 2) ?></td>
                            <td style="color: var(--danger);">-₦<?= number_format(array_sum(array_column($items, 'advance_deduction')), 2) ?></td>
                            <td>-</td>
                            <td style="color: var(--success);">₦<?= number_format(array_sum(array_column($items, 'net_salary')), 2) ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
