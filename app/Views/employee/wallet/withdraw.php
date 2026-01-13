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

<div class="grid grid-2">
    <!-- Withdrawal Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Withdraw Funds</h3>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (empty($employee['bank_name']) || empty($employee['account_number'])): ?>
                <div class="alert alert-warning">
                    <strong>Bank Details Required</strong>
                    <p style="margin: 8px 0 0;">Please update your bank details in your profile before making a withdrawal.</p>
                    <a href="<?= base_url('employee/profile') ?>" class="btn btn-outline" style="margin-top: 12px;">Update Profile</a>
                </div>
            <?php else: ?>
                <form action="<?= base_url('employee/wallet/withdraw') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label class="form-label">Available Balance</label>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">
                            ₦<?= number_format($wallet['balance'], 2) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="form-label">Amount to Withdraw (₦) *</label>
                        <input type="number" id="amount" name="amount" class="form-input"
                               value="<?= old('amount') ?>"
                               min="100"
                               max="<?= $wallet['balance'] ?>"
                               step="0.01"
                               required>
                        <small style="color: var(--gray-500);">Minimum withdrawal: ₦100</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bank Account</label>
                        <div style="background: var(--gray-50); padding: 16px; border-radius: 8px; border: 1px solid var(--gray-200);">
                            <div style="font-weight: 600;"><?= esc($employee['bank_name']) ?></div>
                            <div style="color: var(--gray-600);"><?= esc($employee['account_number']) ?></div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($employee['account_name'] ?? $employee['first_name'] . ' ' . $employee['last_name']) ?></div>
                        </div>
                        <small style="color: var(--gray-500);">
                            <a href="<?= base_url('employee/profile') ?>">Change bank account</a>
                        </small>
                    </div>

                    <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
                        <button type="submit" class="btn btn-primary" <?= $wallet['balance'] < 100 ? 'disabled' : '' ?>>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
                            Withdraw Funds
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Withdrawal Info -->
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Withdrawal Information</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: var(--secondary); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div>
                            <div style="font-weight: 600;">Processing Time</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;">Withdrawals are processed within 24 hours on business days.</div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: var(--secondary); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        </div>
                        <div>
                            <div style="font-weight: 600;">No Fees</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;">All withdrawals to your bank account are free of charge.</div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: var(--secondary); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </div>
                        <div>
                            <div style="font-weight: 600;">Secure Transfer</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;">All transactions are encrypted and processed securely.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($pendingWithdrawals)): ?>
        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3 class="card-title">Pending Withdrawals</h3>
            </div>
            <div class="card-body">
                <?php foreach ($pendingWithdrawals as $withdrawal): ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid var(--gray-100);">
                        <div>
                            <div style="font-weight: 600;">₦<?= number_format($withdrawal['amount'], 2) ?></div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;"><?= date('M j, Y', strtotime($withdrawal['created_at'])) ?></div>
                        </div>
                        <span class="badge badge-warning">Processing</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
