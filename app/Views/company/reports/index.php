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
    <a href="<?= base_url('company/reports') ?>" class="nav-link active">
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
<!-- Summary Stats -->
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-label">Total Employees</div>
        <div class="stat-value"><?= number_format($stats['total_employees']) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Active Employees</div>
        <div class="stat-value" style="color: var(--success);"><?= number_format($stats['active_employees']) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">YTD Payroll</div>
        <div class="stat-value"><?= number_format($stats['ytd_payroll'], 2) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">YTD Advances</div>
        <div class="stat-value"><?= number_format($stats['ytd_advances'], 2) ?></div>
    </div>
</div>

<!-- Report Types -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Available Reports</h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <a href="<?= base_url('company/reports/payroll') ?>" class="card" style="text-decoration: none; padding: 24px; text-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="margin-bottom: 16px;">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <h4 style="margin: 0 0 8px 0; color: var(--text-primary);">Payroll Reports</h4>
                <p style="margin: 0; color: var(--text-secondary); font-size: 14px;">View payroll history, summaries, and analytics</p>
            </a>

            <a href="<?= base_url('company/reports/employees') ?>" class="card" style="text-decoration: none; padding: 24px; text-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="margin-bottom: 16px;">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <h4 style="margin: 0 0 8px 0; color: var(--text-primary);">Employee Reports</h4>
                <p style="margin: 0; color: var(--text-secondary); font-size: 14px;">Employee statistics, advances, and salary data</p>
            </a>

            <a href="<?= base_url('company/reports/transactions') ?>" class="card" style="text-decoration: none; padding: 24px; text-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="margin-bottom: 16px;">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
                <h4 style="margin: 0 0 8px 0; color: var(--text-primary);">Transaction Reports</h4>
                <p style="margin: 0; color: var(--text-secondary); font-size: 14px;">Wallet transactions, funding, and disbursements</p>
            </a>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="card" style="margin-top: 24px;">
    <div class="card-header">
        <h3 class="card-title">Quick Statistics</h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
            <div>
                <h4 style="margin: 0 0 16px 0;">Payroll Overview</h4>
                <table class="table">
                    <tr>
                        <td>Total Payroll Runs</td>
                        <td style="text-align: right;"><strong><?= number_format($stats['total_payroll_runs']) ?></strong></td>
                    </tr>
                    <tr>
                        <td>Year-to-Date Payroll</td>
                        <td style="text-align: right;"><strong><?= number_format($stats['ytd_payroll'], 2) ?></strong></td>
                    </tr>
                </table>
            </div>
            <div>
                <h4 style="margin: 0 0 16px 0;">Advances Overview</h4>
                <table class="table">
                    <tr>
                        <td>Total Advance Requests</td>
                        <td style="text-align: right;"><strong><?= number_format($stats['total_advances']) ?></strong></td>
                    </tr>
                    <tr>
                        <td>Year-to-Date Advances</td>
                        <td style="text-align: right;"><strong><?= number_format($stats['ytd_advances'], 2) ?></strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
