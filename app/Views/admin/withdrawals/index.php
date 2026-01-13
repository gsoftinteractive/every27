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
    <a href="<?= base_url('admin/companies') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
        Companies
    </a>
    <a href="<?= base_url('admin/employees') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
        Employees
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('admin/withdrawals') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        Withdrawals
        <?php if ($counts['pending'] > 0): ?>
            <span class="badge badge-warning" style="margin-left: auto;"><?= $counts['pending'] ?></span>
        <?php endif; ?>
    </a>
    <a href="<?= base_url('admin/fundings') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        Funding Requests
    </a>
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
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Status Tabs -->
<div style="display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap;">
    <a href="<?= base_url('admin/withdrawals') ?>" class="btn <?= !$filter ? 'btn-primary' : 'btn-outline' ?>">
        All (<?= array_sum($counts) ?>)
    </a>
    <a href="<?= base_url('admin/withdrawals?status=pending') ?>" class="btn <?= $filter === 'pending' ? 'btn-primary' : 'btn-outline' ?>">
        Pending (<?= $counts['pending'] ?>)
    </a>
    <a href="<?= base_url('admin/withdrawals?status=processing') ?>" class="btn <?= $filter === 'processing' ? 'btn-primary' : 'btn-outline' ?>">
        Processing (<?= $counts['processing'] ?>)
    </a>
    <a href="<?= base_url('admin/withdrawals?status=completed') ?>" class="btn <?= $filter === 'completed' ? 'btn-primary' : 'btn-outline' ?>">
        Completed (<?= $counts['completed'] ?>)
    </a>
    <a href="<?= base_url('admin/withdrawals?status=rejected') ?>" class="btn <?= $filter === 'rejected' ? 'btn-primary' : 'btn-outline' ?>">
        Rejected (<?= $counts['rejected'] ?>)
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Employee Withdrawal Requests</h3>
    </div>
    <div class="card-body">
        <?php if (empty($withdrawals)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No withdrawal requests found</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Employee</th>
                            <th>Company</th>
                            <th>Amount</th>
                            <th>Bank Details</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($withdrawals as $withdrawal): ?>
                            <tr>
                                <td><strong><?= esc($withdrawal['reference']) ?></strong></td>
                                <td>
                                    <?= esc($withdrawal['first_name'] . ' ' . $withdrawal['last_name']) ?>
                                    <div style="font-size: 0.75rem; color: var(--gray-500);"><?= esc($withdrawal['employee_email']) ?></div>
                                </td>
                                <td><?= esc($withdrawal['company_name']) ?></td>
                                <td><strong style="color: var(--primary);">NGN <?= number_format($withdrawal['amount'], 2) ?></strong></td>
                                <td>
                                    <div style="font-size: 0.875rem;"><?= esc($withdrawal['bank_name']) ?></div>
                                    <div style="font-size: 0.75rem; color: var(--gray-500);"><?= esc($withdrawal['account_number']) ?></div>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $withdrawal['status'] === 'pending' ? 'warning' : ($withdrawal['status'] === 'completed' ? 'success' : ($withdrawal['status'] === 'processing' ? 'info' : 'danger')) ?>">
                                        <?= ucfirst($withdrawal['status']) ?>
                                    </span>
                                </td>
                                <td><?= date('M j, Y H:i', strtotime($withdrawal['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/withdrawals/' . $withdrawal['id']) ?>" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.75rem;">View</a>
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
