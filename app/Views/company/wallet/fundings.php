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
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('company/wallet') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        Wallet
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('company/wallet') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Wallet
</a>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Funding History</h3>
        <a href="<?= base_url('company/wallet/fund') ?>" class="btn btn-primary">Fund Wallet</a>
    </div>
    <div class="card-body">
        <?php if (empty($fundings)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No funding requests yet</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Sender Bank</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fundings as $funding): ?>
                            <tr>
                                <td><strong><?= esc($funding['reference']) ?></strong></td>
                                <td><strong style="color: var(--success);">NGN <?= number_format($funding['amount'], 2) ?></strong></td>
                                <td>
                                    <div style="font-size: 0.875rem;"><?= esc($funding['sender_bank']) ?></div>
                                    <div style="font-size: 0.75rem; color: var(--gray-500);"><?= esc($funding['sender_account_name']) ?></div>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $funding['status'] === 'pending' ? 'warning' : ($funding['status'] === 'approved' ? 'success' : ($funding['status'] === 'processing' ? 'info' : 'danger')) ?>">
                                        <?= ucfirst($funding['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?= date('M j, Y', strtotime($funding['created_at'])) ?>
                                    <div style="font-size: 0.75rem; color: var(--gray-500);"><?= date('H:i', strtotime($funding['created_at'])) ?></div>
                                </td>
                                <td>
                                    <?php if (!empty($funding['admin_notes'])): ?>
                                        <span style="font-size: 0.875rem; color: var(--gray-600);"><?= esc($funding['admin_notes']) ?></span>
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
