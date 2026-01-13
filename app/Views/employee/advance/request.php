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
    <a href="<?= base_url('employee/wallet') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        My Wallet
    </a>
    <a href="<?= base_url('employee/advance') ?>" class="nav-link active">
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
<a href="<?= base_url('employee/advance') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Salary Advance
</a>

<div class="grid grid-2">
    <!-- Request Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Request Salary Advance</h3>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-error">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <div><?= $error ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('employee/advance/request') ?>" method="POST" id="advanceForm">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label class="form-label">Your Monthly Salary</label>
                    <div style="font-size: 1.25rem; font-weight: 600; color: var(--gray-700);">
                        ₦<?= number_format($employee['monthly_salary'], 2) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Maximum Advance (50%)</label>
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--success);">
                        ₦<?= number_format($maxAdvance, 2) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount" class="form-label">Amount to Request (₦) *</label>
                    <input type="number" id="amount" name="amount" class="form-input"
                           value="<?= old('amount') ?>"
                           min="1000"
                           max="<?= $maxAdvance ?>"
                           step="100"
                           required
                           oninput="calculateFee()">
                    <small style="color: var(--gray-500);">Minimum: ₦1,000 | Maximum: ₦<?= number_format($maxAdvance, 2) ?></small>
                </div>

                <div class="form-group">
                    <label for="reason" class="form-label">Reason for Request</label>
                    <textarea id="reason" name="reason" class="form-input" rows="3" placeholder="Optional: Explain why you need this advance..."><?= old('reason') ?></textarea>
                </div>

                <!-- Fee Calculation -->
                <div style="background: var(--gray-50); padding: 16px; border-radius: 8px; margin-top: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span>Requested Amount:</span>
                        <span id="displayAmount">₦0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span>Processing Fee (7%):</span>
                        <span id="displayFee" style="color: var(--danger);">₦0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px solid var(--gray-200); font-weight: 600;">
                        <span>Total Repayment:</span>
                        <span id="displayTotal">₦0.00</span>
                    </div>
                </div>

                <div style="margin-top: 24px;">
                    <label style="display: flex; align-items: flex-start; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="agree_terms" required style="margin-top: 4px;">
                        <span style="font-size: 0.875rem; color: var(--gray-600);">
                            I understand that the total repayment amount (including the 7% fee) will be deducted from my next salary on the 27th.
                        </span>
                    </label>
                </div>

                <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Information Panel -->
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">How It Works</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 32px; height: 32px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0;">1</div>
                        <div>
                            <div style="font-weight: 600;">Submit Request</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;">Request up to 50% of your monthly salary as an advance.</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 16px;">
                        <div style="width: 32px; height: 32px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0;">2</div>
                        <div>
                            <div style="font-weight: 600;">Company Approval</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;">Your employer reviews and approves the request.</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 16px;">
                        <div style="width: 32px; height: 32px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0;">3</div>
                        <div>
                            <div style="font-weight: 600;">Receive Funds</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;">Once approved, funds are credited to your wallet instantly.</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 16px;">
                        <div style="width: 32px; height: 32px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0;">4</div>
                        <div>
                            <div style="font-weight: 600;">Automatic Repayment</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;">The total amount (plus 7% fee) is deducted from your next salary.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 20px; border-left: 4px solid var(--warning);">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; gap: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--warning)" stroke-width="2" style="flex-shrink: 0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <div>
                        <div style="font-weight: 600; color: var(--gray-800);">Important Notice</div>
                        <p style="margin: 8px 0 0; color: var(--gray-600); font-size: 0.875rem;">
                            You can only have one active salary advance at a time. A new advance cannot be requested until the current one is fully repaid.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calculateFee() {
    const amount = parseFloat(document.getElementById('amount').value) || 0;
    const fee = amount * 0.07;
    const total = amount + fee;

    document.getElementById('displayAmount').textContent = '₦' + amount.toLocaleString('en-NG', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    document.getElementById('displayFee').textContent = '₦' + fee.toLocaleString('en-NG', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    document.getElementById('displayTotal').textContent = '₦' + total.toLocaleString('en-NG', {minimumFractionDigits: 2, maximumFractionDigits: 2});
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', calculateFee);
</script>
<?= $this->endSection() ?>
