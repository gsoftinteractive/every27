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
<a href="<?= base_url('employee/wallet') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Wallet
</a>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Withdrawal History</h3>
        <a href="<?= base_url('employee/wallet/withdraw') ?>" class="btn btn-primary">New Withdrawal</a>
    </div>
    <div class="card-body">
        <?php if (empty($withdrawals)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No withdrawal requests yet</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Bank Details</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($withdrawals as $withdrawal): ?>
                            <tr>
                                <td><strong><?= esc($withdrawal['reference']) ?></strong></td>
                                <td><strong style="color: var(--primary);">NGN <?= number_format($withdrawal['amount'], 2) ?></strong></td>
                                <td>
                                    <div style="font-size: 0.875rem;"><?= esc($withdrawal['bank_name']) ?></div>
                                    <div style="font-size: 0.75rem; color: var(--gray-500);"><?= esc($withdrawal['account_number']) ?></div>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $withdrawal['status'] === 'pending' ? 'warning' : ($withdrawal['status'] === 'completed' ? 'success' : ($withdrawal['status'] === 'processing' ? 'info' : 'danger')) ?>">
                                        <?= ucfirst($withdrawal['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?= date('M j, Y', strtotime($withdrawal['created_at'])) ?>
                                    <div style="font-size: 0.75rem; color: var(--gray-500);"><?= date('H:i', strtotime($withdrawal['created_at'])) ?></div>
                                </td>
                                <td>
                                    <?php if (!empty($withdrawal['admin_notes'])): ?>
                                        <span style="font-size: 0.875rem; color: var(--gray-600);"><?= esc($withdrawal['admin_notes']) ?></span>
                                    <?php else: ?>
                                        <span style="color: var(--gray-400);">-</span>
                                    <?php endif; ?>
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
