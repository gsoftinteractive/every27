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
    <a href="<?= base_url('admin/withdrawals') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        Withdrawals
    </a>
    <a href="<?= base_url('admin/fundings') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        Funding Requests
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div style="margin-bottom: 20px;">
    <a href="<?= base_url('admin/fundings') ?>" class="btn btn-outline">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Back to Funding Requests
    </a>
</div>

<div class="grid grid-2">
    <!-- Funding Details -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Funding Request Details</h3>
            <span class="badge badge-<?= $funding['status'] === 'pending' ? 'warning' : ($funding['status'] === 'approved' ? 'success' : ($funding['status'] === 'processing' ? 'info' : 'danger')) ?>">
                <?= ucfirst($funding['status']) ?>
            </span>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 16px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Reference</label>
                    <strong><?= esc($funding['reference']) ?></strong>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Amount</label>
                    <strong style="font-size: 1.5rem; color: var(--success);">NGN <?= number_format($funding['amount'], 2) ?></strong>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Payment Method</label>
                    <span><?= ucfirst(str_replace('_', ' ', $funding['payment_method'])) ?></span>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Request Date</label>
                    <span><?= date('F j, Y \a\t H:i', strtotime($funding['created_at'])) ?></span>
                </div>
                <?php if ($funding['processed_at']): ?>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Processed Date</label>
                    <span><?= date('F j, Y \a\t H:i', strtotime($funding['processed_at'])) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($funding['admin_notes'])): ?>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Admin Notes</label>
                    <span><?= esc($funding['admin_notes']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Transfer Details -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Transfer Details</h3>
        </div>
        <div class="card-body">
            <div style="background: var(--gray-50); padding: 20px; border-radius: 8px; display: grid; gap: 16px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Sender Bank</label>
                    <strong style="font-size: 1.125rem;"><?= esc($funding['sender_bank']) ?></strong>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Sender Account Name</label>
                    <strong><?= esc($funding['sender_account_name']) ?></strong>
                </div>
                <?php if (!empty($funding['transfer_reference'])): ?>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">Transfer Reference</label>
                    <strong style="font-family: monospace;"><?= esc($funding['transfer_reference']) ?></strong>
                </div>
                <?php endif; ?>
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
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block;">RC Number</label>
                    <span><?= esc($company['rc_number'] ?? 'N/A') ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Receipt -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Payment Receipt</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($funding['receipt_path'])): ?>
                <div style="text-align: center;">
                    <a href="<?= base_url('admin/fundings/' . $funding['id'] . '/receipt') ?>" target="_blank" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        View Receipt
                    </a>
                    <p style="margin-top: 10px; font-size: 0.875rem; color: var(--gray-500);">
                        Opens in new tab
                    </p>
                </div>
            <?php else: ?>
                <p style="color: var(--gray-500); text-align: center; padding: 20px;">No receipt uploaded</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($funding['status'] === 'pending' || $funding['status'] === 'processing'): ?>
<!-- Actions -->
<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3 class="card-title">Process Funding Request</h3>
    </div>
    <div class="card-body">
        <div style="background: #d1ecf1; padding: 16px; border-radius: 8px; margin-bottom: 20px;">
            <strong>Instructions:</strong>
            <ol style="margin: 10px 0 0 20px;">
                <li>Verify the payment receipt matches the claimed transfer details</li>
                <li>Check your bank statement to confirm receipt of <strong>NGN <?= number_format($funding['amount'], 2) ?></strong></li>
                <li>If confirmed, click "Approve & Credit Wallet" to credit the company's wallet</li>
                <li>The company will receive an email notification</li>
            </ol>
        </div>

        <div style="display: flex; gap: 16px; flex-wrap: wrap;">
            <!-- Approve Form -->
            <form action="<?= base_url('admin/fundings/' . $funding['id'] . '/approve') ?>" method="POST" style="flex: 1; min-width: 300px;">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="notes">Admin Notes (Optional)</label>
                    <textarea name="notes" id="notes" rows="2" class="form-control" placeholder="e.g., Verified in bank statement on [date]"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you have verified the payment? This will credit NGN <?= number_format($funding['amount'], 2) ?> to the company wallet.')">
                    Approve & Credit Wallet
                </button>
            </form>

            <!-- Reject Form -->
            <form action="<?= base_url('admin/fundings/' . $funding['id'] . '/reject') ?>" method="POST" style="flex: 1; min-width: 300px;">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="reason">Rejection Reason <span style="color: red;">*</span></label>
                    <textarea name="reason" id="reason" rows="2" class="form-control" placeholder="Explain why the funding request is being rejected" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this funding request?')">
                    Reject Request
                </button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?= $this->endSection() ?>
