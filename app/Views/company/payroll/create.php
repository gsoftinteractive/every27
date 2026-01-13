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
    <a href="<?= base_url('company/payroll') ?>" class="nav-link active">
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
<a href="<?= base_url('company/payroll') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Payroll
</a>

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

<div class="grid grid-2">
    <!-- Payroll Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Run Payroll</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('company/payroll/create') ?>" method="POST" id="payrollForm">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="payroll_month" class="form-label">Payroll Month *</label>
                    <input type="month" id="payroll_month" name="payroll_month" class="form-input"
                           value="<?= old('payroll_month') ?: date('Y-m') ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Employees to Pay</label>
                    <div style="background: var(--gray-50); padding: 16px; border-radius: 8px; border: 1px solid var(--gray-200);">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Active Employees</span>
                            <span style="font-weight: 600;"><?= count($employees) ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Total Gross Salary</span>
                            <span style="font-weight: 600;">₦<?= number_format($totalSalary, 2) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Payroll Summary -->
                <div style="background: var(--secondary); padding: 20px; border-radius: 8px; margin-top: 20px;">
                    <h4 style="margin-bottom: 16px; color: var(--gray-800);">Payroll Summary</h4>
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <div style="display: flex; justify-content: space-between;">
                            <span>Total Gross Salary</span>
                            <span>₦<?= number_format($totalSalary, 2) ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Advance Deductions</span>
                            <span style="color: var(--success);">- ₦<?= number_format($advanceDeductions, 2) ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Net Payable to Employees</span>
                            <span>₦<?= number_format($totalSalary - $advanceDeductions, 2) ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; color: var(--primary);">
                            <span>Platform Fee (1%)</span>
                            <span>₦<?= number_format($platformFee, 2) ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 2px solid var(--primary); font-weight: 700; font-size: 1.125rem;">
                            <span>Total Required</span>
                            <span>₦<?= number_format($totalRequired, 2) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Wallet Balance Check -->
                <div style="margin-top: 20px; padding: 16px; border-radius: 8px; background: <?= $walletBalance >= $totalRequired ? '#ecfdf5' : '#fef2f2' ?>; border: 1px solid <?= $walletBalance >= $totalRequired ? 'var(--success)' : 'var(--danger)' ?>;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <div style="font-weight: 600; color: <?= $walletBalance >= $totalRequired ? 'var(--success)' : 'var(--danger)' ?>;">
                                Wallet Balance: ₦<?= number_format($walletBalance, 2) ?>
                            </div>
                            <?php if ($walletBalance < $totalRequired): ?>
                                <div style="color: var(--danger); font-size: 0.875rem; margin-top: 4px;">
                                    Insufficient funds. You need ₦<?= number_format($totalRequired - $walletBalance, 2) ?> more.
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($walletBalance < $totalRequired): ?>
                            <a href="<?= base_url('company/wallet/fund') ?>" class="btn btn-primary" style="padding: 8px 16px;">Fund Wallet</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div style="margin-top: 24px;">
                    <label style="display: flex; align-items: flex-start; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="confirm" required style="margin-top: 4px;">
                        <span style="font-size: 0.875rem; color: var(--gray-600);">
                            I confirm that I want to process this payroll. This will debit ₦<?= number_format($totalRequired, 2) ?> from the company wallet and credit employee wallets.
                        </span>
                    </label>
                </div>

                <div style="margin-top: 24px;">
                    <button type="submit" class="btn btn-primary" style="width: 100%;" <?= $walletBalance < $totalRequired ? 'disabled' : '' ?>>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Process Payroll
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Employee List -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employees (<?= count($employees) ?>)</h3>
        </div>
        <div class="card-body" style="max-height: 600px; overflow-y: auto;">
            <?php if (empty($employees)): ?>
                <div style="text-align: center; padding: 40px 20px;">
                    <p style="color: var(--gray-500);">No active employees found.</p>
                    <a href="<?= base_url('company/employees/create') ?>" class="btn btn-outline" style="margin-top: 12px;">Add Employee</a>
                </div>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <?php foreach ($employees as $emp): ?>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: var(--gray-50); border-radius: 8px;">
                            <div>
                                <div style="font-weight: 600;"><?= esc($emp['first_name'] . ' ' . $emp['last_name']) ?></div>
                                <div style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($emp['position'] ?: $emp['department'] ?: 'Employee') ?></div>
                            </div>
                            <div style="text-align: right;">
                                <div style="font-weight: 600;">₦<?= number_format($emp['monthly_salary'], 2) ?></div>
                                <?php if (!empty($emp['advance_deduction']) && $emp['advance_deduction'] > 0): ?>
                                    <div style="color: var(--danger); font-size: 0.75rem;">-₦<?= number_format($emp['advance_deduction'], 2) ?> advance</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
