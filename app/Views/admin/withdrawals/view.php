<?= $this->extend('layouts/dashboard') ?>

<?php $userType = 'admin'; ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        Dashboard
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('admin/withdrawals') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        Withdrawals
    </a>
    <a href="<?= base_url('admin/fundings') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        Funding Requests
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div style="margin-bottom: 20px;">
    <a href="<?= base_url('admin/withdrawals') ?>" class="btn btn-outline">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Back to Withdrawals
    </a>
</div>

<div class="grid grid-2">
    <!-- Withdrawal Details -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Withdrawal Details</h3>
            <span class="badge badge-<?= $withdrawal['status'] === 'pending' ? 'warning' : ($withdrawal['status'] === 'completed' ? 'success' : ($withdrawal['status'] === 'processing' ? 'info' : 'danger')) ?>">
                <?= ucfirst($withdrawal['status']) ?>
            </span>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 16px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Reference</label>
                    <strong><?= esc($withdrawal['reference']) ?></strong>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Amount</label>
                    <strong style="font-size: 1.5rem; color: var(--primary);">NGN <?= number_format($withdrawal['amount'], 2) ?></strong>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Request Date</label>
                    <span><?= date('F j, Y \a\t H:i', strtotime($withdrawal['created_at'])) ?></span>
                </div>
                <?php if ($withdrawal['processed_at']): ?>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Processed Date</label>
                    <span><?= date('F j, Y \a\t H:i', strtotime($withdrawal['processed_at'])) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($withdrawal['admin_notes'])): ?>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Admin Notes</label>
                    <span><?= esc($withdrawal['admin_notes']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bank Details -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bank Details (Transfer To)</h3>
        </div>
        <div class="card-body">
            <div style="background: var(--gray-50); padding: 20px; border-radius: 8px; display: grid; gap: 16px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Bank Name</label>
                    <strong style="font-size: 1.125rem;"><?= esc($withdrawal['bank_name']) ?></strong>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Account Number</label>
                    <strong style="font-size: 1.25rem; font-family: monospace;"><?= esc($withdrawal['account_number']) ?></strong>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Account Name</label>
                    <strong><?= esc($withdrawal['account_name']) ?></strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Info -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee Information</h3>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 12px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Name</label>
                    <span><?= esc($employee['first_name'] . ' ' . $employee['last_name']) ?></span>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Email</label>
                    <span><?= esc($employee['email']) ?></span>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Phone</label>
                    <span><?= esc($employee['phone'] ?? 'N/A') ?></span>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Monthly Salary</label>
                    <span>NGN <?= number_format($employee['salary'], 2) ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Company Info -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Company Information</h3>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 12px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Company Name</label>
                    <span><?= esc($company['name']) ?></span>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Email</label>
                    <span><?= esc($company['email']) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($withdrawal['status'] === 'pending' || $withdrawal['status'] === 'processing'): ?>
<!-- Actions -->
<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3 class="card-title">Process Withdrawal</h3>
    </div>
    <div class="card-body">
        <div style="background: #fff3cd; padding: 16px; border-radius: 8px; margin-bottom: 20px;">
            <strong>Instructions:</strong>
            <ol style="margin: 10px 0 0 20px;">
                <li>Transfer <strong>NGN <?= number_format($withdrawal['amount'], 2) ?></strong> to the bank account above</li>
                <li>After successful transfer, click "Approve & Mark Complete" to debit the employee's wallet</li>
                <li>The employee will receive an email notification</li>
            </ol>
        </div>

        <div style="display: flex; gap: 16px; flex-wrap: wrap;">
            <!-- Approve Form -->
            <form action="<?= base_url('admin/withdrawals/' . $withdrawal['id'] . '/approve') ?>" method="POST" style="flex: 1; min-width: 300px;">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="notes">Admin Notes (Optional)</label>
                    <textarea name="notes" id="notes" rows="2" class="form-control" placeholder="e.g., Transfer reference number"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you have completed the bank transfer? This will debit the employee wallet.')">
                    Approve & Mark Complete
                </button>
            </form>

            <!-- Reject Form -->
            <form action="<?= base_url('admin/withdrawals/' . $withdrawal['id'] . '/reject') ?>" method="POST" style="flex: 1; min-width: 300px;">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="reason">Rejection Reason <span style="color: red;">*</span></label>
                    <textarea name="reason" id="reason" rows="2" class="form-control" placeholder="Explain why the withdrawal is being rejected" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this withdrawal request?')">
                    Reject Withdrawal
                </button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?= $this->endSection() ?>
