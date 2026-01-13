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
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Advance Eligibility Card -->
<div class="card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; margin-bottom: 24px;">
    <div class="card-body">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="opacity: 0.9; margin-bottom: 8px;">Maximum Advance Available</p>
                <h2 style="font-size: 2.5rem; font-weight: 700; margin: 0;">₦<?= number_format($maxAdvance, 2) ?></h2>
                <p style="opacity: 0.8; margin-top: 8px; font-size: 0.875rem;">Up to 50% of your monthly salary</p>
            </div>
            <?php if ($canRequest): ?>
                <a href="<?= base_url('employee/advance/request') ?>" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Request Advance
                </a>
            <?php else: ?>
                <span class="badge" style="background: rgba(255,255,255,0.2); color: white; padding: 8px 16px;">
                    <?= $activeAdvance ? 'Active Advance' : 'Not Eligible' ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($activeAdvance): ?>
<!-- Active Advance Card -->
<div class="card" style="margin-bottom: 24px; border-left: 4px solid var(--warning);">
    <div class="card-header">
        <h3 class="card-title">Active Salary Advance</h3>
        <span class="badge badge-<?= $activeAdvance['status'] === 'pending' ? 'warning' : ($activeAdvance['status'] === 'approved' ? 'info' : 'success') ?>">
            <?= ucfirst($activeAdvance['status']) ?>
        </span>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <div>
                <div style="color: var(--gray-500); font-size: 0.875rem;">Requested Amount</div>
                <div style="font-size: 1.25rem; font-weight: 600;">₦<?= number_format($activeAdvance['amount_requested'], 2) ?></div>
            </div>
            <?php if ($activeAdvance['amount_approved']): ?>
            <div>
                <div style="color: var(--gray-500); font-size: 0.875rem;">Approved Amount</div>
                <div style="font-size: 1.25rem; font-weight: 600; color: var(--success);">₦<?= number_format($activeAdvance['amount_approved'], 2) ?></div>
            </div>
            <?php endif; ?>
            <div>
                <div style="color: var(--gray-500); font-size: 0.875rem;">Fee (7%)</div>
                <div style="font-size: 1.25rem; font-weight: 600;">₦<?= number_format($activeAdvance['fee_amount'], 2) ?></div>
            </div>
            <div>
                <div style="color: var(--gray-500); font-size: 0.875rem;">Total Repayment</div>
                <div style="font-size: 1.25rem; font-weight: 600; color: var(--danger);">₦<?= number_format($activeAdvance['total_repayment'], 2) ?></div>
            </div>
        </div>

        <?php if ($activeAdvance['status'] === 'disbursed'): ?>
        <div style="margin-top: 20px; padding: 16px; background: var(--secondary); border-radius: 8px;">
            <div style="display: flex; align-items: center; gap: 8px; color: var(--primary);">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <span style="font-weight: 600;">Repayment Notice</span>
            </div>
            <p style="margin: 8px 0 0; color: var(--gray-600);">
                ₦<?= number_format($activeAdvance['total_repayment'], 2) ?> will be deducted from your next salary on the 27th.
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<!-- Advance History -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Advance History</h3>
    </div>
    <div class="card-body">
        <?php if (empty($advances)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No salary advance history</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Requested</th>
                            <th>Approved</th>
                            <th>Fee</th>
                            <th>Repayment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($advances as $advance): ?>
                            <tr>
                                <td><?= date('M j, Y', strtotime($advance['created_at'])) ?></td>
                                <td>₦<?= number_format($advance['amount_requested'], 2) ?></td>
                                <td>
                                    <?php if ($advance['amount_approved']): ?>
                                        ₦<?= number_format($advance['amount_approved'], 2) ?>
                                    <?php else: ?>
                                        <span style="color: var(--gray-400);">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>₦<?= number_format($advance['fee_amount'], 2) ?></td>
                                <td>₦<?= number_format($advance['total_repayment'], 2) ?></td>
                                <td>
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
