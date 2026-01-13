<?= $this->extend('layouts/dashboard') ?>

<?php $userType = 'company'; ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('company/dashboard') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
        </svg>
        Dashboard
    </a>
</div>

<div class="nav-section">
    <div class="nav-section-title">Employees</div>
    <a href="<?= base_url('company/employees') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
        Manage Employees
    </a>
</div>

<div class="nav-section">
    <div class="nav-section-title">Payroll</div>
    <a href="<?= base_url('company/payroll') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        Payroll Runs
    </a>
    <a href="<?= base_url('company/advances') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        Salary Advances
        <?php if (!empty($stats['pending_advances'])): ?>
            <span class="badge badge-warning" style="margin-left: auto;"><?= $stats['pending_advances'] ?></span>
        <?php endif; ?>
    </a>
</div>

<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('company/wallet') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
            <line x1="1" y1="10" x2="23" y2="10"></line>
        </svg>
        Wallet
    </a>
    <a href="<?= base_url('company/reports') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10"></line>
            <line x1="12" y1="20" x2="12" y2="4"></line>
            <line x1="6" y1="20" x2="6" y2="14"></line>
        </svg>
        Reports
    </a>
</div>

<div class="nav-section">
    <div class="nav-section-title">Settings</div>
    <a href="<?= base_url('company/profile') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
        </svg>
        Company Profile
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if ($needsVerification): ?>
<div class="alert alert-warning">
    <strong>Verification Pending:</strong> Your company is not yet verified. Please upload your CAC documents in <a href="<?= base_url('company/profile') ?>">Company Profile</a>.
</div>
<?php endif; ?>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Wallet Balance</div>
        <div class="stat-value">₦<?= number_format($stats['wallet_balance'], 2) ?></div>
        <a href="<?= base_url('company/wallet/fund') ?>" style="font-size: 0.875rem; color: var(--primary); text-decoration: none;">Fund Wallet →</a>
    </div>
    <div class="stat-card">
        <div class="stat-label">Active Employees</div>
        <div class="stat-value"><?= number_format($stats['active_employees']) ?></div>
        <div class="stat-change"><?= $stats['total_employees'] ?> total</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Monthly Payroll</div>
        <div class="stat-value">₦<?= number_format($stats['monthly_payroll'], 2) ?></div>
        <div class="stat-change">Including platform fee</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Pending Advances</div>
        <div class="stat-value"><?= number_format($stats['pending_advances']) ?></div>
        <?php if ($stats['pending_advances'] > 0): ?>
            <a href="<?= base_url('company/advances') ?>" style="font-size: 0.875rem; color: var(--warning); text-decoration: none;">Review →</a>
        <?php endif; ?>
    </div>
</div>

<div class="grid grid-2">
    <!-- Recent Transactions -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Transactions</h3>
            <a href="<?= base_url('company/wallet/transactions') ?>" class="btn btn-outline">View All</a>
        </div>
        <div class="card-body">
            <?php if (empty($recentTransactions)): ?>
                <p style="color: var(--gray-500); text-align: center; padding: 20px;">No transactions yet</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentTransactions as $txn): ?>
                                <tr>
                                    <td>
                                        <span class="badge badge-<?= $txn['type'] === 'credit' ? 'success' : 'danger' ?>">
                                            <?= ucfirst(str_replace('_', ' ', $txn['category'])) ?>
                                        </span>
                                    </td>
                                    <td style="color: <?= $txn['type'] === 'credit' ? 'var(--success)' : 'var(--danger)' ?>">
                                        <?= $txn['type'] === 'credit' ? '+' : '-' ?>₦<?= number_format($txn['amount'], 2) ?>
                                    </td>
                                    <td><?= date('M j, g:ia', strtotime($txn['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Payroll Runs -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Payroll</h3>
            <a href="<?= base_url('company/payroll/create') ?>" class="btn btn-primary">Run Payroll</a>
        </div>
        <div class="card-body">
            <?php if (empty($recentPayrolls)): ?>
                <p style="color: var(--gray-500); text-align: center; padding: 20px;">No payroll runs yet</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentPayrolls as $payroll): ?>
                                <tr>
                                    <td><?= date('F Y', strtotime($payroll['payroll_month'] . '-01')) ?></td>
                                    <td>₦<?= number_format($payroll['total_amount'], 2) ?></td>
                                    <td>
                                        <span class="badge badge-<?= $payroll['status'] === 'completed' ? 'success' : ($payroll['status'] === 'failed' ? 'danger' : 'warning') ?>">
                                            <?= ucfirst($payroll['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
