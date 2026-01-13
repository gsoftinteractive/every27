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
    <a href="<?= base_url('employee/advance') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        Salary Advance
    </a>
    <a href="<?= base_url('employee/payslips') ?>" class="nav-link active">
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
<a href="<?= base_url('employee/payslips') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Payslips
</a>

<div class="card" style="max-width: 800px;" id="payslip">
    <div class="card-header" style="background: var(--primary); color: white; border-radius: 12px 12px 0 0;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="margin: 0; font-size: 1.25rem;">Payslip</h3>
                <p style="margin: 4px 0 0; opacity: 0.9;"><?= date('F Y', strtotime($payslip['payroll_month'] . '-01')) ?></p>
            </div>
            <span class="badge" style="background: rgba(255,255,255,0.2); color: white;">
                <?= ucfirst($payslip['status']) ?>
            </span>
        </div>
    </div>
    <div class="card-body">
        <!-- Company & Employee Info -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--gray-200); margin-bottom: 20px;">
            <div>
                <div style="color: var(--gray-500); font-size: 0.875rem; margin-bottom: 4px;">Employee</div>
                <div style="font-weight: 600;"><?= esc($employee['first_name'] . ' ' . $employee['last_name']) ?></div>
                <div style="color: var(--gray-600);"><?= esc($employee['position'] ?: 'Employee') ?></div>
                <div style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($employee['department'] ?: '-') ?></div>
            </div>
            <div style="text-align: right;">
                <div style="color: var(--gray-500); font-size: 0.875rem; margin-bottom: 4px;">Payment Date</div>
                <div style="font-weight: 600;"><?= date('M j, Y', strtotime($payslip['paid_at'] ?? $payslip['created_at'])) ?></div>
            </div>
        </div>

        <!-- Earnings -->
        <div style="margin-bottom: 24px;">
            <h4 style="color: var(--gray-800); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Earnings
            </h4>
            <div style="background: var(--gray-50); border-radius: 8px; padding: 16px;">
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-200);">
                    <span>Basic Salary</span>
                    <span style="font-weight: 600;">₦<?= number_format($payslip['gross_salary'], 2) ?></span>
                </div>
                <?php if (!empty($payslip['bonuses']) && $payslip['bonuses'] > 0): ?>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-200);">
                    <span>Bonuses</span>
                    <span style="font-weight: 600;">₦<?= number_format($payslip['bonuses'], 2) ?></span>
                </div>
                <?php endif; ?>
                <div style="display: flex; justify-content: space-between; padding: 12px 0; font-weight: 600; color: var(--success);">
                    <span>Total Earnings</span>
                    <span>₦<?= number_format($payslip['gross_salary'] + ($payslip['bonuses'] ?? 0), 2) ?></span>
                </div>
            </div>
        </div>

        <!-- Deductions -->
        <div style="margin-bottom: 24px;">
            <h4 style="color: var(--gray-800); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--danger)" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Deductions
            </h4>
            <div style="background: var(--gray-50); border-radius: 8px; padding: 16px;">
                <?php if (!empty($payslip['tax_amount']) && $payslip['tax_amount'] > 0): ?>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-200);">
                    <span>Tax (PAYE)</span>
                    <span style="color: var(--danger);">-₦<?= number_format($payslip['tax_amount'], 2) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($payslip['pension_amount']) && $payslip['pension_amount'] > 0): ?>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-200);">
                    <span>Pension</span>
                    <span style="color: var(--danger);">-₦<?= number_format($payslip['pension_amount'], 2) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($payslip['advance_deduction']) && $payslip['advance_deduction'] > 0): ?>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-200);">
                    <span>Salary Advance Repayment</span>
                    <span style="color: var(--danger);">-₦<?= number_format($payslip['advance_deduction'], 2) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($payslip['other_deductions']) && $payslip['other_deductions'] > 0): ?>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-200);">
                    <span>Other Deductions</span>
                    <span style="color: var(--danger);">-₦<?= number_format($payslip['other_deductions'], 2) ?></span>
                </div>
                <?php endif; ?>
                <div style="display: flex; justify-content: space-between; padding: 12px 0; font-weight: 600; color: var(--danger);">
                    <span>Total Deductions</span>
                    <span>-₦<?= number_format($payslip['total_deductions'], 2) ?></span>
                </div>
            </div>
        </div>

        <!-- Net Pay -->
        <div style="background: linear-gradient(135deg, var(--primary) 0%, #0b6bc5 100%); color: white; padding: 24px; border-radius: 12px; text-align: center;">
            <div style="opacity: 0.9; margin-bottom: 8px;">Net Salary</div>
            <div style="font-size: 2.5rem; font-weight: 700;">₦<?= number_format($payslip['net_salary'], 2) ?></div>
            <div style="opacity: 0.8; font-size: 0.875rem; margin-top: 8px;">Credited to wallet</div>
        </div>

        <!-- Actions -->
        <div style="margin-top: 24px; display: flex; gap: 12px; justify-content: center;">
            <button onclick="window.print()" class="btn btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                Print Payslip
            </button>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #payslip, #payslip * {
        visibility: visible;
    }
    #payslip {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none !important;
    }
    .btn {
        display: none !important;
    }
}
</style>
<?= $this->endSection() ?>
