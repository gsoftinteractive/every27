<?= $this->extend('layouts/dashboard') ?>

<?php $userType = 'employee'; ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('employee/dashboard') ?>" class="nav-link active">
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
    <div class="nav-section-title">Money</div>
    <a href="<?= base_url('employee/wallet') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
            <line x1="1" y1="10" x2="23" y2="10"></line>
        </svg>
        My Wallet
    </a>
    <a href="<?= base_url('employee/advance') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        Salary Advance
    </a>
    <a href="<?= base_url('employee/payslips') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
        </svg>
        Payslips
    </a>
</div>

<div class="nav-section">
    <div class="nav-section-title">Account</div>
    <a href="<?= base_url('employee/profile') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
        </svg>
        My Profile
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Payday Countdown -->
<div class="card" style="background: linear-gradient(135deg, var(--primary) 0%, #0b6bc5 100%); color: white; margin-bottom: 24px;">
    <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h3 style="font-size: 1.25rem; margin-bottom: 4px;">Next Payday</h3>
            <p style="opacity: 0.9; margin: 0;">27th of every month</p>
        </div>
        <div style="text-align: right;">
            <div style="font-size: 2.5rem; font-weight: 700;"><?= $daysUntilPayday ?></div>
            <div style="opacity: 0.9; font-size: 0.875rem;">days to go</div>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Wallet Balance</div>
        <div class="stat-value">₦<?= number_format($stats['wallet_balance'], 2) ?></div>
        <a href="<?= base_url('employee/wallet/withdraw') ?>" style="font-size: 0.875rem; color: var(--primary); text-decoration: none;">Withdraw →</a>
    </div>
    <div class="stat-card">
        <div class="stat-label">Monthly Salary</div>
        <div class="stat-value">₦<?= number_format($stats['monthly_salary'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Advance Available</div>
        <div class="stat-value">₦<?= number_format($stats['max_advance_amount'], 2) ?></div>
        <?php if ($stats['can_request_advance']): ?>
            <a href="<?= base_url('employee/advance/request') ?>" style="font-size: 0.875rem; color: var(--success); text-decoration: none;">Request →</a>
        <?php else: ?>
            <span style="font-size: 0.875rem; color: var(--gray-400);">Not available</span>
        <?php endif; ?>
    </div>
</div>

<?php if ($activeAdvance): ?>
<!-- Active Advance -->
<div class="alert alert-info" style="background: var(--secondary); border: 1px solid var(--primary);">
    <strong>Active Salary Advance:</strong> You have a
    <span class="badge badge-<?= $activeAdvance['status'] === 'pending' ? 'warning' : ($activeAdvance['status'] === 'disbursed' ? 'success' : 'info') ?>">
        <?= ucfirst($activeAdvance['status']) ?>
    </span>
    advance of ₦<?= number_format($activeAdvance['amount_approved'] ?? $activeAdvance['amount_requested'], 2) ?>.
    <?php if ($activeAdvance['status'] === 'disbursed'): ?>
        Repayment of ₦<?= number_format($activeAdvance['total_repayment'], 2) ?> will be deducted from your next salary.
    <?php endif; ?>
</div>
<?php endif; ?>

<div class="grid grid-2">
    <!-- Recent Transactions -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Transactions</h3>
            <a href="<?= base_url('employee/wallet/transactions') ?>" class="btn btn-outline">View All</a>
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

    <!-- Recent Payslips -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Payslips</h3>
            <a href="<?= base_url('employee/payslips') ?>" class="btn btn-outline">View All</a>
        </div>
        <div class="card-body">
            <?php if (empty($recentPayslips)): ?>
                <p style="color: var(--gray-500); text-align: center; padding: 20px;">No payslips yet</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Net Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentPayslips as $payslip): ?>
                                <tr>
                                    <td><?= date('F Y', strtotime($payslip['payroll_month'] . '-01')) ?></td>
                                    <td>₦<?= number_format($payslip['net_salary'], 2) ?></td>
                                    <td>
                                        <a href="<?= base_url('employee/payslips/' . $payslip['id']) ?>" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.75rem;">View</a>
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
