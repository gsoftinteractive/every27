<?= $this->extend('layouts/dashboard') ?>

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
    <a href="<?= base_url('admin/transactions') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        Transactions
    </a>
    <a href="<?= base_url('admin/withdrawals') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        Withdrawals
    </a>
    <a href="<?= base_url('admin/fundings') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
        Fundings
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Stats Summary -->
<div class="stats-grid" style="grid-template-columns: repeat(5, 1fr); margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-label">Total</div>
        <div class="stat-value"><?= number_format($counts['total']) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Credits</div>
        <div class="stat-value" style="color: var(--success);"><?= number_format($counts['credit']) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Debits</div>
        <div class="stat-value" style="color: var(--danger);"><?= number_format($counts['debit']) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Completed</div>
        <div class="stat-value"><?= number_format($counts['completed']) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Pending</div>
        <div class="stat-value" style="color: var(--warning);"><?= number_format($counts['pending']) ?></div>
    </div>
</div>

<!-- Filters -->
<div style="display: flex; gap: 12px; margin-bottom: 24px;">
    <a href="<?= base_url('admin/transactions') ?>" class="btn <?= empty($currentType) && empty($currentStatus) ? 'btn-primary' : 'btn-outline' ?>">All</a>
    <a href="<?= base_url('admin/transactions?type=credit') ?>" class="btn <?= $currentType === 'credit' ? 'btn-primary' : 'btn-outline' ?>">Credits</a>
    <a href="<?= base_url('admin/transactions?type=debit') ?>" class="btn <?= $currentType === 'debit' ? 'btn-primary' : 'btn-outline' ?>">Debits</a>
    <a href="<?= base_url('admin/transactions?status=pending') ?>" class="btn <?= $currentStatus === 'pending' ? 'btn-primary' : 'btn-outline' ?>">Pending</a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Transactions</h3>
    </div>
    <div class="card-body">
        <?php if (empty($transactions)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No transactions found.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Wallet</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $txn): ?>
                            <tr>
                                <td><code style="font-size: 0.8125rem;"><?= esc($txn['reference']) ?></code></td>
                                <td>
                                    <div style="font-weight: 500;"><?= esc($txn['owner_name'] ?? 'Unknown') ?></div>
                                    <div style="font-size: 0.75rem; color: var(--gray-500);"><?= ucfirst($txn['wallet_type'] ?? 'N/A') ?></div>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $txn['type'] === 'credit' ? 'success' : 'danger' ?>">
                                        <?= ucfirst($txn['type']) ?>
                                    </span>
                                </td>
                                <td style="font-weight: 600; color: <?= $txn['type'] === 'credit' ? 'var(--success)' : 'var(--danger)' ?>;">
                                    <?= $txn['type'] === 'credit' ? '+' : '-' ?>NGN <?= number_format($txn['amount'], 2) ?>
                                </td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <?= esc($txn['description'] ?? '-') ?>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $txn['status'] === 'completed' ? 'success' : ($txn['status'] === 'pending' ? 'warning' : 'secondary') ?>">
                                        <?= ucfirst($txn['status']) ?>
                                    </span>
                                </td>
                                <td><?= date('M j, Y H:i', strtotime($txn['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
