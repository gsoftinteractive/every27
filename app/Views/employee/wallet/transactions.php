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
    <a href="<?= base_url('employee/advance') ?>" class="nav-link">Salary Advance</a>
    <a href="<?= base_url('employee/payslips') ?>" class="nav-link">Payslips</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('employee/wallet') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Wallet
</a>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Transaction History</h3>
    </div>
    <div class="card-body">
        <?php if (empty($transactions)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No transactions yet</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $tx): ?>
                    <tr>
                        <td style="font-family: monospace; font-size: 0.875rem;"><?= esc($tx['reference']) ?></td>
                        <td>
                            <span class="badge badge-<?= $tx['type'] === 'credit' ? 'success' : 'danger' ?>">
                                <?= ucfirst($tx['type']) ?>
                            </span>
                        </td>
                        <td><?= ucfirst(str_replace('_', ' ', $tx['category'])) ?></td>
                        <td style="font-weight: 600; color: <?= $tx['type'] === 'credit' ? 'var(--success)' : 'var(--danger)' ?>;">
                            <?= $tx['type'] === 'credit' ? '+' : '-' ?>&#8358;<?= number_format($tx['amount'], 2) ?>
                        </td>
                        <td>&#8358;<?= number_format($tx['balance_after'], 2) ?></td>
                        <td><?= date('M j, Y H:i', strtotime($tx['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
