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
        <form method="GET" style="display: flex; gap: 16px; align-items: flex-end; flex-wrap: wrap;">
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="<?= $filters['start_date'] ?? '' ?>">
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" value="<?= $filters['end_date'] ?? '' ?>">
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Type</label>
                <select name="type" class="form-control">
                    <option value="">All Types</option>
                    <option value="credit" <?= ($filters['type'] ?? '') === 'credit' ? 'selected' : '' ?>>Credit</option>
                    <option value="debit" <?= ($filters['type'] ?? '') === 'debit' ? 'selected' : '' ?>>Debit</option>
                </select>
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Category</label>
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    <option value="funding" <?= ($filters['category'] ?? '') === 'funding' ? 'selected' : '' ?>>Funding</option>
                    <option value="payroll" <?= ($filters['category'] ?? '') === 'payroll' ? 'selected' : '' ?>>Payroll</option>
                    <option value="advance" <?= ($filters['category'] ?? '') === 'advance' ? 'selected' : '' ?>>Advance</option>
                    <option value="fee" <?= ($filters['category'] ?? '') === 'fee' ? 'selected' : '' ?>>Fee</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
</div>

<!-- Summary Stats -->
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-label">Total Credits</div>
        <div class="stat-value" style="color: var(--success);"><?= number_format($summary['total_credits'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Debits</div>
        <div class="stat-value" style="color: var(--danger);"><?= number_format($summary['total_debits'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Net Flow</div>
        <div class="stat-value" style="color: <?= ($summary['net_flow'] ?? 0) >= 0 ? 'var(--success)' : 'var(--danger)' ?>;">
            <?= number_format($summary['net_flow'] ?? 0, 2) ?>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Transactions</div>
        <div class="stat-value"><?= number_format($summary['transaction_count']) ?></div>
    </div>
</div>

<!-- Transaction List -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Transaction History</h3>
    </div>
    <div class="card-body">
        <?php if (empty($transactions)): ?>
        <div class="empty-state">
            <p>No transactions found for the selected period.</p>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Reference</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th style="text-align: right;">Amount</th>
                    <th style="text-align: right;">Balance After</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $txn): ?>
                <tr>
                    <td><?= date('M d, Y H:i', strtotime($txn['created_at'])) ?></td>
                    <td><code><?= esc($txn['reference']) ?></code></td>
                    <td><?= esc($txn['description']) ?></td>
                    <td><span class="badge badge-secondary"><?= ucfirst($txn['category']) ?></span></td>
                    <td style="text-align: right; color: <?= $txn['type'] === 'credit' ? 'var(--success)' : 'var(--danger)' ?>;">
                        <?= $txn['type'] === 'credit' ? '+' : '-' ?><?= number_format($txn['amount'], 2) ?>
                    </td>
                    <td style="text-align: right;"><?= number_format($txn['balance_after'], 2) ?></td>
                    <td><span class="badge badge-<?= $txn['status'] === 'completed' ? 'success' : 'warning' ?>"><?= ucfirst($txn['status']) ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
