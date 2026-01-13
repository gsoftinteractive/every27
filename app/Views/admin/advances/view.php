<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">Dashboard</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('admin/transactions') ?>" class="nav-link">Transactions</a>
    <a href="<?= base_url('admin/withdrawals') ?>" class="nav-link">Withdrawals</a>
    <a href="<?= base_url('admin/fundings') ?>" class="nav-link">Fundings</a>
    <a href="<?= base_url('admin/advances') ?>" class="nav-link active">Salary Advances</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('admin/advances') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Advances
</a>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" style="margin-bottom: 20px;"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Advance Details</h3>
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
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Amount Requested</label>
                    <p style="margin: 4px 0 16px; font-weight: 600; color: var(--primary-color);">&#8358;<?= number_format($advance['amount_requested'], 2) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Fee (7%)</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;">&#8358;<?= number_format($advance['fee_amount'] ?? 0, 2) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Total Repayment</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;">&#8358;<?= number_format($advance['total_repayment'] ?? 0, 2) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Requested</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= date('M j, Y H:i', strtotime($advance['created_at'])) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Salary %</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= number_format($advance['percentage_of_salary'] ?? 0, 1) ?>%</p>
                </div>
            </div>

            <?php if (!empty($advance['approval_notes'])): ?>
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--gray-200);">
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Notes</label>
                <p style="margin: 4px 0;"><?= esc($advance['approval_notes']) ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div>
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header">
                <h3 class="card-title">Employee</h3>
            </div>
            <div class="card-body">
                <p style="font-weight: 600; margin-bottom: 4px;"><?= esc($employee['first_name'] . ' ' . $employee['last_name']) ?></p>
                <p style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($employee['email']) ?></p>
                <p style="color: var(--gray-500); font-size: 0.875rem; margin-top: 8px;">Monthly Salary: &#8358;<?= number_format($employee['monthly_salary'], 2) ?></p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Company</h3>
            </div>
            <div class="card-body">
                <p style="font-weight: 600; margin-bottom: 4px;"><?= esc($company['company_name']) ?></p>
                <p style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($company['email']) ?></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
