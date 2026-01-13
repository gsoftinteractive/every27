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
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('admin/transactions') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        Transactions
    </a>
    <a href="<?= base_url('admin/advances') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        Salary Advances
    </a>
    <a href="<?= base_url('admin/payroll') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        Payroll
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Settings</div>
    <a href="<?= base_url('admin/users') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        Admin Users
    </a>
    <a href="<?= base_url('admin/settings') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
        Settings
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

<!-- Header with Create Button -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div style="display: flex; gap: 12px;">
        <a href="<?= base_url('admin/companies') ?>" class="btn <?= empty($currentStatus) ? 'btn-primary' : 'btn-outline' ?>">
            All (<?= $counts['total'] ?>)
        </a>
        <a href="<?= base_url('admin/companies?status=verified') ?>" class="btn <?= $currentStatus === 'verified' ? 'btn-primary' : 'btn-outline' ?>">
            Verified (<?= $counts['verified'] ?>)
        </a>
        <a href="<?= base_url('admin/companies?status=pending') ?>" class="btn <?= $currentStatus === 'pending' ? 'btn-primary' : 'btn-outline' ?>">
            Pending (<?= $counts['pending'] ?>)
        </a>
        <a href="<?= base_url('admin/companies?status=suspended') ?>" class="btn <?= $currentStatus === 'suspended' ? 'btn-primary' : 'btn-outline' ?>">
            Suspended (<?= $counts['suspended'] ?>)
        </a>
    </div>
    <a href="<?= base_url('admin/companies/create') ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Create Company
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Companies</h3>
    </div>
    <div class="card-body">
        <?php if (empty($companies)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No companies found.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>RC Number</th>
                            <th>Employees</th>
                            <th>Wallet</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($companies as $company): ?>
                            <tr>
                                <td>
                                    <div style="font-weight: 600;"><?= esc($company['company_name']) ?></div>
                                    <div style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($company['email']) ?></div>
                                </td>
                                <td>
                                    <div><?= esc($company['contact_name']) ?></div>
                                    <div style="color: var(--gray-500); font-size: 0.875rem;"><?= esc($company['phone']) ?></div>
                                </td>
                                <td style="font-family: monospace;"><?= esc($company['rc_number']) ?></td>
                                <td><?= number_format($company['employee_count'] ?? 0) ?></td>
                                <td>₦<?= number_format($company['wallet_balance'] ?? 0, 2) ?></td>
                                <td>
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
                                </td>
                                <td><?= date('M j, Y', strtotime($company['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/companies/' . $company['id']) ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.875rem;">
                                        View
                                    </a>
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
