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
    <a href="<?= base_url('company/wallet') ?>" class="nav-link active">
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

<!-- Wallet Balance Card -->
<div class="card" style="background: linear-gradient(135deg, var(--primary) 0%, #0b6bc5 100%); color: white; margin-bottom: 24px;">
    <div class="card-body">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <p style="opacity: 0.9; margin-bottom: 8px;">Wallet Balance</p>
                <h2 style="font-size: 2.5rem; font-weight: 700; margin: 0;">₦<?= number_format($wallet['balance'], 2) ?></h2>
                <p style="opacity: 0.8; margin-top: 8px; font-size: 0.875rem;">Available for payroll and disbursements</p>
            </div>
            <a href="<?= base_url('company/wallet/fund') ?>" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3);">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Fund Wallet
            </a>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-label">Total Funded</div>
        <div class="stat-value" style="color: var(--success);">₦<?= number_format($stats['total_funded'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Disbursed</div>
        <div class="stat-value" style="color: var(--danger);">₦<?= number_format($stats['total_disbursed'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">This Month's Payroll</div>
        <div class="stat-value">₦<?= number_format($stats['monthly_payroll'], 2) ?></div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Transactions</h3>
        <a href="<?= base_url('company/wallet/transactions') ?>" class="btn btn-outline">View All</a>
    </div>
    <div class="card-body">
        <?php if (empty($transactions)): ?>
            <div style="text-align: center; padding: 60px 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--gray-300)" stroke-width="1.5" style="margin-bottom: 16px;"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                <h3 style="color: var(--gray-500); margin-bottom: 8px;">No Transactions Yet</h3>
                <p style="color: var(--gray-400); margin-bottom: 20px;">Fund your wallet to get started.</p>
                <a href="<?= base_url('company/wallet/fund') ?>" class="btn btn-primary">Fund Wallet</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Reference</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $txn): ?>
                            <tr>
                                <td><?= date('M j, Y g:ia', strtotime($txn['created_at'])) ?></td>
                                <td><?= esc($txn['description']) ?></td>
                                <td style="font-family: monospace; font-size: 0.875rem; color: var(--gray-500);">
                                    <?= esc($txn['reference'] ?? '-') ?>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $txn['type'] === 'credit' ? 'success' : 'danger' ?>">
                                        <?= ucfirst($txn['type']) ?>
                                    </span>
                                </td>
                                <td style="font-weight: 600; color: <?= $txn['type'] === 'credit' ? 'var(--success)' : 'var(--danger)' ?>;">
                                    <?= $txn['type'] === 'credit' ? '+' : '-' ?>₦<?= number_format($txn['amount'], 2) ?>
                                </td>
                                <td>₦<?= number_format($txn['balance_after'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
