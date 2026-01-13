<?= $this->extend('layouts/dashboard') ?>

<?php $userType = 'employee'; ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('employee/dashboard') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        Dashboard
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Money</div>
    <a href="<?= base_url('employee/wallet') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        My Wallet
    </a>
    <a href="<?= base_url('employee/advance') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        Salary Advance
    </a>
    <a href="<?= base_url('employee/payslips') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
        Payslips
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Account</div>
    <a href="<?= base_url('employee/profile') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        My Profile
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Wallet Balance Card -->
<div class="card" style="background: linear-gradient(135deg, var(--primary) 0%, #0b6bc5 100%); color: white; margin-bottom: 24px;">
    <div class="card-body">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <p style="opacity: 0.9; margin-bottom: 8px;">Available Balance</p>
                <h2 style="font-size: 2.5rem; font-weight: 700; margin: 0;">₦<?= number_format($wallet['balance'], 2) ?></h2>
            </div>
            <a href="<?= base_url('employee/wallet/withdraw') ?>" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3);">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
                Withdraw
            </a>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="stats-grid" style="grid-template-columns: repeat(3, 1fr);">
    <div class="stat-card">
        <div class="stat-label">Total Credited</div>
        <div class="stat-value" style="color: var(--success);">₦<?= number_format($stats['total_credited'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Withdrawn</div>
        <div class="stat-value" style="color: var(--danger);">₦<?= number_format($stats['total_withdrawn'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Pending Withdrawals</div>
        <div class="stat-value">₦<?= number_format($stats['pending_withdrawals'], 2) ?></div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Transactions</h3>
        <a href="<?= base_url('employee/wallet/transactions') ?>" class="btn btn-outline">View All</a>
    </div>
    <div class="card-body">
        <?php if (empty($transactions)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No transactions yet</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
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
                                <td>
                                    <span class="badge badge-<?= $txn['type'] === 'credit' ? 'success' : 'danger' ?>">
                                        <?= ucfirst($txn['type']) ?>
                                    </span>
                                </td>
                                <td style="color: <?= $txn['type'] === 'credit' ? 'var(--success)' : 'var(--danger)' ?>; font-weight: 600;">
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
