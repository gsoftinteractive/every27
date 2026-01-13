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
    <a href="<?= base_url('company/advances') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        Salary Advances
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('company/wallet') ?>" class="nav-link">
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
<a href="<?= base_url('company/advances') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Advances
</a>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="grid grid-2">
    <!-- Request Details -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Advance Request Details</h3>
            <span class="badge badge-<?php
                echo match($advance['status']) {
                    'pending' => 'warning',
                    'approved' => 'info',
                    'disbursed' => 'success',
                    'repaid' => 'success',
                    'rejected' => 'danger',
                    default => 'secondary'
                };
            ?>">
                <?= ucfirst($advance['status']) ?>
            </span>
        </div>
        <div class="card-body">
            <!-- Employee Info -->
            <div style="background: var(--gray-50); padding: 16px; border-radius: 8px; margin-bottom: 20px;">
                <div style="font-weight: 600; margin-bottom: 8px;">Employee Information</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Name</div>
                        <div><?= esc($employee['first_name'] . ' ' . $employee['last_name']) ?></div>
                    </div>
                    <div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Department</div>
                        <div><?= esc($employee['department'] ?: '-') ?></div>
                    </div>
                    <div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Position</div>
                        <div><?= esc($employee['position'] ?: '-') ?></div>
                    </div>
                    <div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Monthly Salary</div>
                        <div>₦<?= number_format($employee['monthly_salary'], 2) ?></div>
                    </div>
                </div>
            </div>

            <!-- Advance Details -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <div style="color: var(--gray-500); font-size: 0.875rem;">Amount Requested</div>
                    <div style="font-size: 1.5rem; font-weight: 700;">₦<?= number_format($advance['amount_requested'], 2) ?></div>
                </div>
                <div>
                    <div style="color: var(--gray-500); font-size: 0.875rem;">Request Date</div>
                    <div style="font-size: 1.25rem; font-weight: 600;"><?= date('M j, Y', strtotime($advance['created_at'])) ?></div>
                </div>
            </div>

            <!-- Fee Calculation -->
            <div style="background: var(--secondary); padding: 16px; border-radius: 8px; margin-top: 20px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span>Principal Amount</span>
                    <span>₦<?= number_format($advance['amount_requested'], 2) ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span>Processing Fee (7%)</span>
                    <span style="color: var(--danger);">₦<?= number_format($advance['fee_amount'], 2) ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px solid var(--primary); font-weight: 600;">
                    <span>Total Repayment</span>
                    <span>₦<?= number_format($advance['total_repayment'], 2) ?></span>
                </div>
            </div>

            <?php if (!empty($advance['reason'])): ?>
            <div style="margin-top: 20px;">
                <div style="color: var(--gray-500); font-size: 0.875rem; margin-bottom: 8px;">Reason for Request</div>
                <div style="background: var(--gray-50); padding: 16px; border-radius: 8px;">
                    <?= nl2br(esc($advance['reason'])) ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($advance['status'] === 'rejected' && !empty($advance['rejection_reason'])): ?>
            <div style="margin-top: 20px; background: #fef2f2; padding: 16px; border-radius: 8px; border: 1px solid var(--danger);">
                <div style="color: var(--danger); font-weight: 600; margin-bottom: 8px;">Rejection Reason</div>
                <div><?= nl2br(esc($advance['rejection_reason'])) ?></div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Actions Panel -->
    <div>
        <?php if ($advance['status'] === 'pending'): ?>
        <!-- Approve Form -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Approve Request</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('company/advances/' . $advance['id'] . '/approve') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="amount" class="form-label">Amount to Approve (₦)</label>
                        <input type="number" id="amount" name="amount" class="form-input"
                               value="<?= $advance['amount_requested'] ?>"
                               min="1000"
                               max="<?= $advance['amount_requested'] ?>"
                               step="100">
                        <small style="color: var(--gray-500);">You can approve a lower amount if needed</small>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="form-label">Notes (Optional)</label>
                        <textarea id="notes" name="notes" class="form-input" rows="2" placeholder="Any notes for this approval..."></textarea>
                    </div>

                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="auto_disburse" value="1" checked>
                            <span>Automatically disburse to employee's wallet</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Approve Request
                    </button>
                </form>
            </div>
        </div>

        <!-- Reject Form -->
        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3 class="card-title">Reject Request</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('company/advances/' . $advance['id'] . '/reject') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="reason" class="form-label">Reason for Rejection *</label>
                        <textarea id="reason" name="reason" class="form-input" rows="3" placeholder="Explain why this request is being rejected..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-outline" style="width: 100%; color: var(--danger); border-color: var(--danger);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        Reject Request
                    </button>
                </form>
            </div>
        </div>
        <?php else: ?>
        <!-- Status Timeline -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Request Timeline</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 32px; height: 32px; background: var(--success); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <div style="font-weight: 600;">Request Submitted</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;"><?= date('M j, Y g:ia', strtotime($advance['created_at'])) ?></div>
                        </div>
                    </div>

                    <?php if ($advance['approved_at']): ?>
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 32px; height: 32px; background: var(--success); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <div style="font-weight: 600;">Approved</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;"><?= date('M j, Y g:ia', strtotime($advance['approved_at'])) ?></div>
                            <?php if ($advance['amount_approved'] != $advance['amount_requested']): ?>
                                <div style="color: var(--primary); font-size: 0.875rem;">Amount adjusted to ₦<?= number_format($advance['amount_approved'], 2) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($advance['disbursed_at']): ?>
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 32px; height: 32px; background: var(--success); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <div style="font-weight: 600;">Disbursed</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;"><?= date('M j, Y g:ia', strtotime($advance['disbursed_at'])) ?></div>
                            <div style="color: var(--success); font-size: 0.875rem;">₦<?= number_format($advance['amount_approved'], 2) ?> credited to wallet</div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($advance['status'] === 'repaid'): ?>
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 32px; height: 32px; background: var(--success); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div>
                            <div style="font-weight: 600;">Repaid</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;">Deducted from salary</div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($advance['status'] === 'rejected'): ?>
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 32px; height: 32px; background: var(--danger); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--danger);">Rejected</div>
                            <div style="color: var(--gray-500); font-size: 0.875rem;"><?= date('M j, Y g:ia', strtotime($advance['updated_at'])) ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
