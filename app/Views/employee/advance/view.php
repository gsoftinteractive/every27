<?= $this->extend('layouts/dashboard') ?>

<?php $userType = 'employee'; ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('employee/dashboard') ?>" class="nav-link">Dashboard</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Money</div>
    <a href="<?= base_url('employee/wallet') ?>" class="nav-link">My Wallet</a>
    <a href="<?= base_url('employee/advance') ?>" class="nav-link active">Salary Advance</a>
    <a href="<?= base_url('employee/payslips') ?>" class="nav-link">Payslips</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('employee/advance') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Advances
</a>

<div class="card" style="max-width: 700px;">
    <div class="card-header">
        <h3 class="card-title">Advance Request</h3>
        <span class="badge badge-<?= $advance['status'] === 'approved' ? 'success' : ($advance['status'] === 'pending' ? 'warning' : ($advance['status'] === 'rejected' ? 'danger' : 'primary')) ?>">
            <?= ucfirst($advance['status']) ?>
        </span>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Reference</label>
                <p style="margin: 4px 0 16px; font-weight: 500;"><?= esc($advance['reference']) ?></p>
            </div>
            <div>
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Requested</label>
                <p style="margin: 4px 0 16px; font-weight: 500;"><?= date('M j, Y H:i', strtotime($advance['created_at'])) ?></p>
            </div>
            <div>
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Amount Requested</label>
                <p style="margin: 4px 0 16px; font-weight: 600; color: var(--primary-color);">&#8358;<?= number_format($advance['amount_requested'], 2) ?></p>
            </div>
            <div>
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Fee (7%)</label>
                <p style="margin: 4px 0 16px; font-weight: 500;">&#8358;<?= number_format($advance['fee_amount'] ?? 0, 2) ?></p>
            </div>
            <?php if ($advance['status'] === 'approved' || $advance['status'] === 'disbursed'): ?>
            <div>
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Amount Approved</label>
                <p style="margin: 4px 0 16px; font-weight: 600; color: var(--success);">&#8358;<?= number_format($advance['amount_approved'] ?? 0, 2) ?></p>
            </div>
            <div>
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Total Repayment</label>
                <p style="margin: 4px 0 16px; font-weight: 500;">&#8358;<?= number_format($advance['total_repayment'] ?? 0, 2) ?></p>
            </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($advance['approval_notes'])): ?>
        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--gray-200);">
            <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Notes</label>
            <p style="margin: 4px 0;"><?= esc($advance['approval_notes']) ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($advance['reason'])): ?>
        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--gray-200);">
            <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Your Reason</label>
            <p style="margin: 4px 0;"><?= esc($advance['reason']) ?></p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
