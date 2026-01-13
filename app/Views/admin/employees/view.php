<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">Dashboard</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Management</div>
    <a href="<?= base_url('admin/access-requests') ?>" class="nav-link">Access Requests</a>
    <a href="<?= base_url('admin/companies') ?>" class="nav-link">Companies</a>
    <a href="<?= base_url('admin/employees') ?>" class="nav-link active">Employees</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('admin/employees') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Employees
</a>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= esc($employee['first_name'] . ' ' . $employee['last_name']) ?></h3>
            <span class="badge badge-<?= $employee['status'] === 'active' ? 'success' : 'danger' ?>"><?= ucfirst($employee['status']) ?></span>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Email</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= esc($employee['email']) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Phone</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= esc($employee['phone'] ?: 'Not set') ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Department</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= esc($employee['department'] ?: 'Not set') ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Position</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= esc($employee['position'] ?: 'Not set') ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Monthly Salary</label>
                    <p style="margin: 4px 0 16px; font-weight: 600; color: var(--primary-color);">&#8358;<?= number_format($employee['monthly_salary'], 2) ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Hire Date</label>
                    <p style="margin: 4px 0 16px; font-weight: 500;"><?= $employee['hire_date'] ? date('M j, Y', strtotime($employee['hire_date'])) : 'Not set' ?></p>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header">
                <h3 class="card-title">Company</h3>
            </div>
            <div class="card-body">
                <p style="font-weight: 600; margin-bottom: 4px;"><?= esc($company['company_name']) ?></p>
                <p style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($company['email']) ?></p>
                <a href="<?= base_url('admin/companies/' . $company['id']) ?>" class="btn btn-sm btn-outline" style="margin-top: 12px;">View Company</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Wallet</h3>
            </div>
            <div class="card-body">
                <?php if ($wallet): ?>
                    <p style="font-size: 0.875rem; color: var(--gray-500);">Balance</p>
                    <p style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color);">&#8358;<?= number_format($wallet['balance'], 2) ?></p>
                    <p style="font-size: 0.75rem; color: var(--gray-400); margin-top: 8px;">ID: #<?= $wallet['id'] ?></p>
                <?php else: ?>
                    <p style="color: var(--gray-500);">No wallet</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($employee['bank_name'])): ?>
<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3 class="card-title">Bank Details</h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div>
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Bank</label>
                <p style="margin: 4px 0; font-weight: 500;"><?= esc($employee['bank_name']) ?></p>
            </div>
            <div>
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Account Number</label>
                <p style="margin: 4px 0; font-weight: 500;"><?= esc($employee['account_number']) ?></p>
            </div>
            <div>
                <label style="font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase;">Account Name</label>
                <p style="margin: 4px 0; font-weight: 500;"><?= esc($employee['account_name'] ?? '') ?></p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?= $this->endSection() ?>
