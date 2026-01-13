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
<div class="card">
    <div class="card-header">
        <h3 class="card-title">My Payslips</h3>
    </div>
    <div class="card-body">
        <?php if (empty($payslips)): ?>
            <div style="text-align: center; padding: 60px 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--gray-300)" stroke-width="1.5" style="margin-bottom: 16px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                <h3 style="color: var(--gray-500); margin-bottom: 8px;">No Payslips Yet</h3>
                <p style="color: var(--gray-400);">Your payslips will appear here after each payroll run.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Gross Salary</th>
                            <th>Deductions</th>
                            <th>Net Salary</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payslips as $payslip): ?>
                            <tr>
                                <td style="font-weight: 600;"><?= date('F Y', strtotime($payslip['payroll_month'] . '-01')) ?></td>
                                <td>₦<?= number_format($payslip['gross_salary'], 2) ?></td>
                                <td style="color: var(--danger);">-₦<?= number_format($payslip['total_deductions'], 2) ?></td>
                                <td style="color: var(--success); font-weight: 600;">₦<?= number_format($payslip['net_salary'], 2) ?></td>
                                <td>
                                    <span class="badge badge-<?= $payslip['status'] === 'paid' ? 'success' : 'warning' ?>">
                                        <?= ucfirst($payslip['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('employee/payslips/' . $payslip['id']) ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.875rem;">
                                        View Details
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
