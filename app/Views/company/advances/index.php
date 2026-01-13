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
        <?php if ($counts['pending'] > 0): ?>
            <span class="badge badge-warning" style="margin-left: auto;"><?= $counts['pending'] ?></span>
        <?php endif; ?>
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
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Status Tabs -->
<div style="display: flex; gap: 12px; margin-bottom: 24px;">
    <a href="<?= base_url('company/advances') ?>" class="btn <?= empty($currentStatus) ? 'btn-primary' : 'btn-outline' ?>">
        All (<?= array_sum($counts) ?>)
    </a>
    <a href="<?= base_url('company/advances?status=pending') ?>" class="btn <?= $currentStatus === 'pending' ? 'btn-primary' : 'btn-outline' ?>">
        <span class="badge badge-warning" style="margin-right: 4px;"><?= $counts['pending'] ?></span> Pending
    </a>
    <a href="<?= base_url('company/advances?status=approved') ?>" class="btn <?= $currentStatus === 'approved' ? 'btn-primary' : 'btn-outline' ?>">
        Approved (<?= $counts['approved'] ?>)
    </a>
    <a href="<?= base_url('company/advances?status=disbursed') ?>" class="btn <?= $currentStatus === 'disbursed' ? 'btn-primary' : 'btn-outline' ?>">
        Disbursed (<?= $counts['disbursed'] ?>)
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Salary Advance Requests</h3>
    </div>
    <div class="card-body">
        <?php if (empty($advances)): ?>
            <div style="text-align: center; padding: 60px 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--gray-300)" stroke-width="1.5" style="margin-bottom: 16px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <h3 style="color: var(--gray-500); margin-bottom: 8px;">No Advance Requests</h3>
                <p style="color: var(--gray-400);">No salary advance requests to display.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Requested</th>
                            <th>Fee (7%)</th>
                            <th>Total Repayment</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($advances as $advance): ?>
                            <tr>
                                <td style="font-weight: 600;"><?= esc($advance['employee_name']) ?></td>
                                <td>₦<?= number_format($advance['amount_requested'], 2) ?></td>
                                <td>₦<?= number_format($advance['fee_amount'], 2) ?></td>
                                <td style="font-weight: 600;">₦<?= number_format($advance['total_repayment'], 2) ?></td>
                                <td><?= date('M j, Y', strtotime($advance['created_at'])) ?></td>
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
                                <td>
                                    <a href="<?= base_url('company/advances/' . $advance['id']) ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.875rem;">
                                        <?= $advance['status'] === 'pending' ? 'Review' : 'View' ?>
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
