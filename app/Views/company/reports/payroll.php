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
    <a href="<?= base_url('company/payroll') ?>" class="nav-link">
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
    <a href="<?= base_url('company/reports') ?>" class="nav-link active">
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
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <a href="<?= base_url('company/reports') ?>" style="color: var(--text-secondary); text-decoration: none; font-size: 14px;">&larr; Back to Reports</a>
    </div>
</div>

<!-- Filters -->
<div class="card" style="margin-bottom: 24px;">
    <div class="card-body">
        <form method="GET" style="display: flex; gap: 16px; align-items: flex-end;">
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Year</label>
                <select name="year" class="form-control">
                    <?php for ($y = date('Y'); $y >= date('Y') - 5; $y--): ?>
                    <option value="<?= $y ?>" <?= ($filters['year'] ?? '') == $y ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Month</label>
                <select name="month" class="form-control">
                    <option value="">All Months</option>
                    <?php
                    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    foreach ($months as $i => $month): ?>
                    <option value="<?= $i + 1 ?>" <?= ($filters['month'] ?? '') == ($i + 1) ? 'selected' : '' ?>><?= $month ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
</div>

<!-- Summary Stats -->
<div class="stats-grid" style="grid-template-columns: repeat(5, 1fr); margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-label">Payroll Runs</div>
        <div class="stat-value"><?= number_format($summary['payroll_count']) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Gross</div>
        <div class="stat-value"><?= number_format($summary['total_gross'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Net</div>
        <div class="stat-value" style="color: var(--success);"><?= number_format($summary['total_net'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Deductions</div>
        <div class="stat-value"><?= number_format($summary['total_deductions'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Platform Fees</div>
        <div class="stat-value"><?= number_format($summary['total_fees'], 2) ?></div>
    </div>
</div>

<!-- Payroll List -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payroll History</h3>
    </div>
    <div class="card-body">
        <?php if (empty($payrolls)): ?>
        <div class="empty-state">
            <p>No payroll runs found for the selected period.</p>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Month</th>
                    <th>Pay Date</th>
                    <th>Employees</th>
                    <th style="text-align: right;">Gross</th>
                    <th style="text-align: right;">Net</th>
                    <th style="text-align: right;">Fee</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payrolls as $payroll): ?>
                <tr>
                    <td><a href="<?= base_url('company/payroll/' . $payroll['id']) ?>"><?= esc($payroll['reference']) ?></a></td>
                    <td><?= date('F Y', strtotime($payroll['payroll_month'] . '-01')) ?></td>
                    <td><?= date('M d, Y', strtotime($payroll['pay_date'])) ?></td>
                    <td><?= $payroll['total_employees'] ?></td>
                    <td style="text-align: right;"><?= number_format($payroll['total_gross_salary'], 2) ?></td>
                    <td style="text-align: right;"><?= number_format($payroll['total_net_salary'], 2) ?></td>
                    <td style="text-align: right;"><?= number_format($payroll['platform_fee'], 2) ?></td>
                    <td><span class="badge badge-<?= $payroll['status'] === 'completed' ? 'success' : 'warning' ?>"><?= ucfirst($payroll['status']) ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
