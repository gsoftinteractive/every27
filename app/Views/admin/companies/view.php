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
    <div class="nav-section-title">Management</div>
    <a href="<?= base_url('admin/access-requests') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
        Access Requests
    </a>
    <a href="<?= base_url('admin/companies') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        Companies
    </a>
    <a href="<?= base_url('admin/employees') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
        Employees
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('admin/companies') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Companies
</a>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="grid grid-2">
    <!-- Company Details -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Company Details</h3>
            <span class="badge badge-<?php
                echo match($company['verification_status']) {
                    'verified' => 'success',
                    'pending' => 'warning',
                    'rejected' => 'danger',
                    'suspended' => 'danger',
                    default => 'secondary'
                };
            ?>">
                <?= ucfirst($company['verification_status']) ?>
            </span>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 16px;">
                <div>
                    <div style="color: var(--gray-500); font-size: 0.875rem;">Company Name</div>
                    <div style="font-weight: 600; font-size: 1.125rem;"><?= esc($company['company_name']) ?></div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">RC Number</div>
                        <div style="font-family: monospace;"><?= esc($company['rc_number']) ?></div>
                    </div>
                    <div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Registered</div>
                        <div><?= date('M j, Y', strtotime($company['created_at'])) ?></div>
                    </div>
                </div>

                <div>
                    <div style="color: var(--gray-500); font-size: 0.875rem;">Contact Person</div>
                    <div><?= esc($company['contact_name']) ?></div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Email</div>
                        <div><?= esc($company['email']) ?></div>
                    </div>
                    <div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Phone</div>
                        <div><?= esc($company['phone']) ?></div>
                    </div>
                </div>

                <?php if (!empty($company['address'])): ?>
                <div>
                    <div style="color: var(--gray-500); font-size: 0.875rem;">Address</div>
                    <div><?= esc($company['address']) ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Stats & Actions -->
    <div>
        <!-- Quick Stats -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistics</h3>
            </div>
            <div class="card-body">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div style="background: var(--gray-50); padding: 16px; border-radius: 8px; text-align: center;">
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary);"><?= number_format($stats['employees']) ?></div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Employees</div>
                    </div>
                    <div style="background: var(--gray-50); padding: 16px; border-radius: 8px; text-align: center;">
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--success);">₦<?= number_format($stats['wallet_balance'], 0) ?></div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Wallet Balance</div>
                    </div>
                    <div style="background: var(--gray-50); padding: 16px; border-radius: 8px; text-align: center;">
                        <div style="font-size: 1.5rem; font-weight: 700;"><?= number_format($stats['payroll_runs']) ?></div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Payroll Runs</div>
                    </div>
                    <div style="background: var(--gray-50); padding: 16px; border-radius: 8px; text-align: center;">
                        <div style="font-size: 1.5rem; font-weight: 700;">₦<?= number_format($stats['total_disbursed'], 0) ?></div>
                        <div style="color: var(--gray-500); font-size: 0.875rem;">Total Disbursed</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3 class="card-title">Actions</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <?php if ($company['verification_status'] === 'pending'): ?>
                        <form action="<?= base_url('admin/companies/' . $company['id'] . '/verify') ?>" method="POST" style="display: contents;">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                Verify Company
                            </button>
                        </form>
                    <?php endif; ?>

                    <?php if ($company['verification_status'] !== 'suspended'): ?>
                        <form action="<?= base_url('admin/companies/' . $company['id'] . '/suspend') ?>" method="POST" style="display: contents;" onsubmit="return confirm('Are you sure you want to suspend this company?');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-outline" style="width: 100%; color: var(--danger); border-color: var(--danger);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                                Suspend Company
                            </button>
                        </form>
                    <?php else: ?>
                        <form action="<?= base_url('admin/companies/' . $company['id'] . '/unsuspend') ?>" method="POST" style="display: contents;">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-outline" style="width: 100%;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                                Unsuspend Company
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Employees List -->
<div class="card" style="margin-top: 24px;">
    <div class="card-header">
        <h3 class="card-title">Employees (<?= count($employees) ?>)</h3>
    </div>
    <div class="card-body">
        <?php if (empty($employees)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No employees registered.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $emp): ?>
                            <tr>
                                <td style="font-weight: 600;"><?= esc($emp['first_name'] . ' ' . $emp['last_name']) ?></td>
                                <td><?= esc($emp['email']) ?></td>
                                <td><?= esc($emp['department'] ?: '-') ?></td>
                                <td>₦<?= number_format($emp['monthly_salary'], 2) ?></td>
                                <td>
                                    <span class="badge badge-<?= $emp['status'] === 'active' ? 'success' : 'danger' ?>">
                                        <?= ucfirst($emp['status']) ?>
                                    </span>
                                </td>
                                <td><?= date('M j, Y', strtotime($emp['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
