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
    <a href="<?= base_url('company/employees') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
        Manage Employees
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('company/employees') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Employees
</a>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" style="margin-bottom: 20px;"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error" style="margin-bottom: 20px;"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
    <!-- Employee Details -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= esc($employee['first_name'] . ' ' . $employee['last_name']) ?></h3>
            <span class="badge badge-<?= $employee['status'] === 'active' ? 'success' : ($employee['status'] === 'suspended' ? 'warning' : 'danger') ?>">
                <?= ucfirst($employee['status']) ?>
            </span>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Email</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= esc($employee['email']) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Phone</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= esc($employee['phone'] ?: 'Not set') ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Department</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= esc($employee['department'] ?: 'Not set') ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Position</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= esc($employee['position'] ?: 'Not set') ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Monthly Salary</label>
                    <p style="margin: 4px 0 16px; font-weight: 500; color: var(--primary-color);">&#8358;<?= number_format($employee['monthly_salary'], 2) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Hire Date</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= $employee['hire_date'] ? date('M j, Y', strtotime($employee['hire_date'])) : 'Not set' ?></p>
                </div>
            </div>

            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-200); display: flex; gap: 12px;">
                <a href="<?= base_url('company/employees/' . $employee['id'] . '/edit') ?>" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    Edit Employee
                </a>
                <?php if ($employee['status'] === 'active'): ?>
                    <form action="<?= base_url('company/employees/' . $employee['id'] . '/deactivate') ?>" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to deactivate this employee?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-outline" style="color: var(--danger);">Deactivate</button>
                    </form>
                <?php else: ?>
                    <form action="<?= base_url('company/employees/' . $employee['id'] . '/activate') ?>" method="POST" style="display: inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-outline" style="color: var(--success);">Activate</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Wallet Info -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Wallet</h3>
        </div>
        <div class="card-body">
            <?php if ($wallet): ?>
                <div style="text-align: center; padding: 20px 0;">
                    <p style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: 8px;">Available Balance</p>
                    <p style="font-size: 2rem; font-weight: 700; color: var(--primary-color); margin: 0;">&#8358;<?= number_format($wallet['balance'], 2) ?></p>
                </div>
                <div style="border-top: 1px solid var(--gray-200); padding-top: 16px; margin-top: 16px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span style="color: var(--gray-500);">Wallet ID</span>
                        <span style="font-family: monospace; font-size: 0.875rem;"><?= esc($wallet['wallet_id']) ?></span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--gray-500);">Status</span>
                        <span class="badge badge-<?= $wallet['status'] === 'active' ? 'success' : 'warning' ?>"><?= ucfirst($wallet['status']) ?></span>
                    </div>
                </div>
            <?php else: ?>
                <p style="color: var(--gray-500); text-align: center; padding: 20px 0;">No wallet found</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bank Details -->
<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3 class="card-title">Bank Details</h3>
    </div>
    <div class="card-body">
        <?php if (!empty($employee['bank_name']) && !empty($employee['account_number'])): ?>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Bank Name</label>
                    <p style="margin: 4px 0; font-weight: 500;"><?= esc($employee['bank_name']) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Account Number</label>
                    <p style="margin: 4px 0; font-weight: 500;"><?= esc($employee['account_number']) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Account Name</label>
                    <p style="margin: 4px 0; font-weight: 500;"><?= esc($employee['account_name'] ?? 'Not set') ?></p>
                </div>
            </div>
        <?php else: ?>
            <p style="color: var(--gray-500);">Bank details not yet provided by employee.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
