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
    <div class="nav-section-title">Employees</div>
    <a href="<?= base_url('company/employees') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
        Manage Employees
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Payroll</div>
    <a href="<?= base_url('company/payroll') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        Payroll Runs
    </a>
    <a href="<?= base_url('company/advances') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        Salary Advances
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('company/wallet') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        Wallet
    </a>
    <a href="<?= base_url('company/reports') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
        Reports
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Settings</div>
    <a href="<?= base_url('company/profile') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        Company Profile
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('company/wallet') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Wallet
</a>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="grid grid-2">
    <!-- Bank Account Details to Transfer To -->
    <div class="card" style="border: 2px solid var(--primary);">
        <div class="card-header" style="background: var(--secondary);">
            <h3 class="card-title">Step 1: Transfer to Our Account</h3>
        </div>
        <div class="card-body">
            <p style="margin-bottom: 20px; color: var(--gray-600);">Transfer your desired amount to the bank account below:</p>

            <div style="background: var(--gray-50); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <div style="margin-bottom: 16px;">
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block; margin-bottom: 4px;">Bank Name</label>
                    <div style="font-size: 1.125rem; font-weight: 700;"><?= esc($platformBankDetails['bank_name']) ?></div>
                </div>
                <div style="margin-bottom: 16px;">
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block; margin-bottom: 4px;">Account Number</label>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="font-size: 1.5rem; font-weight: 700; font-family: monospace; letter-spacing: 2px;" id="accountNumber"><?= esc($platformBankDetails['account_number']) ?></div>
                        <button type="button" onclick="copyAccountNumber()" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.75rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            Copy
                        </button>
                    </div>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); display: block; margin-bottom: 4px;">Account Name</label>
                    <div style="font-size: 1.125rem; font-weight: 600;"><?= esc($platformBankDetails['account_name']) ?></div>
                </div>
            </div>

            <div style="background: #fff3cd; padding: 16px; border-radius: 8px;">
                <div style="display: flex; align-items: flex-start; gap: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#856404" stroke-width="2" style="flex-shrink: 0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <div style="font-size: 0.875rem; color: #856404;">
                        <strong>Important:</strong> Use your company name as the transfer narration/reference to help us identify your payment faster.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Receipt Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Step 2: Upload Payment Receipt</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('company/wallet/fund') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label class="form-label">Current Balance</label>
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">
                        NGN <?= number_format($wallet['balance'], 2) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount" class="form-label">Amount Transferred (NGN) *</label>
                    <input type="number" id="amount" name="amount" class="form-input"
                           min="1000"
                           step="0.01"
                           placeholder="Enter amount you transferred"
                           required>
                    <small style="color: var(--gray-500);">Minimum: NGN 1,000</small>
                </div>

                <!-- Quick Amount Buttons -->
                <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px;">
                    <button type="button" class="btn btn-outline" onclick="setAmount(50000)">NGN 50,000</button>
                    <button type="button" class="btn btn-outline" onclick="setAmount(100000)">NGN 100,000</button>
                    <button type="button" class="btn btn-outline" onclick="setAmount(500000)">NGN 500,000</button>
                </div>

                <div class="form-group">
                    <label for="sender_bank" class="form-label">Your Bank Name *</label>
                    <input type="text" id="sender_bank" name="sender_bank" class="form-input"
                           placeholder="e.g., Zenith Bank, GTBank, Access Bank"
                           required>
                </div>

                <div class="form-group">
                    <label for="sender_account_name" class="form-label">Your Account Name *</label>
                    <input type="text" id="sender_account_name" name="sender_account_name" class="form-input"
                           placeholder="Name on your bank account"
                           value="<?= esc($company['name'] ?? '') ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="transfer_reference" class="form-label">Transfer Reference (Optional)</label>
                    <input type="text" id="transfer_reference" name="transfer_reference" class="form-input"
                           placeholder="Bank transfer reference/session ID">
                </div>

                <div class="form-group">
                    <label for="receipt" class="form-label">Payment Receipt/Proof *</label>
                    <input type="file" id="receipt" name="receipt" class="form-input"
                           accept="image/*,.pdf"
                           required>
                    <small style="color: var(--gray-500);">Upload screenshot of successful transfer or bank receipt (JPG, PNG, PDF - max 5MB)</small>
                </div>

                <div style="margin-top: 24px;">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        Submit Funding Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (!empty($pendingFundings)): ?>
<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3 class="card-title">Pending Funding Requests</h3>
        <a href="<?= base_url('company/wallet/fundings') ?>" class="btn btn-outline">View All</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendingFundings as $funding): ?>
                        <tr>
                            <td><strong><?= esc($funding['reference']) ?></strong></td>
                            <td>NGN <?= number_format($funding['amount'], 2) ?></td>
                            <td>
                                <span class="badge badge-<?= $funding['status'] === 'pending' ? 'warning' : 'info' ?>">
                                    <?= ucfirst($funding['status']) ?>
                                </span>
                            </td>
                            <td><?= date('M j, Y H:i', strtotime($funding['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
function setAmount(amount) {
    document.getElementById('amount').value = amount;
}

function copyAccountNumber() {
    const accountNumber = document.getElementById('accountNumber').textContent;
    navigator.clipboard.writeText(accountNumber).then(() => {
        alert('Account number copied to clipboard!');
    });
}
</script>
<?= $this->endSection() ?>
