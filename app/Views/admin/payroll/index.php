<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">Dashboard</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Management</div>
    <a href="<?= base_url('admin/companies') ?>" class="nav-link">Companies</a>
    <a href="<?= base_url('admin/employees') ?>" class="nav-link">Employees</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('admin/transactions') ?>" class="nav-link">Transactions</a>
    <a href="<?= base_url('admin/payroll') ?>" class="nav-link active">Payroll</a>
    <a href="<?= base_url('admin/withdrawals') ?>" class="nav-link">Withdrawals</a>
    <a href="<?= base_url('admin/fundings') ?>" class="nav-link">Fundings</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div style="display: flex; gap: 12px; margin-bottom: 24px;">
    <a href="<?= base_url('admin/payroll') ?>" class="btn <?= empty($currentStatus) ? 'btn-primary' : 'btn-outline' ?>">All (<?= $counts['total'] ?>)</a>
    <a href="<?= base_url('admin/payroll?status=pending') ?>" class="btn <?= $currentStatus === 'pending' ? 'btn-primary' : 'btn-outline' ?>">Pending (<?= $counts['pending'] ?>)</a>
    <a href="<?= base_url('admin/payroll?status=processed') ?>" class="btn <?= $currentStatus === 'processed' ? 'btn-primary' : 'btn-outline' ?>">Processed (<?= $counts['processed'] ?>)</a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($payrolls)): ?>
            <p style="text-align: center; color: var(--gray-500); padding: 40px;">No payroll runs found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Period</th>
                        <th>Employees</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payrolls as $payroll): ?>
                    <tr>
                        <td><?= esc($payroll['company_name']) ?></td>
                        <td><?= date('M Y', strtotime($payroll['pay_period_start'])) ?></td>
                        <td><?= $payroll['employee_count'] ?></td>
                        <td>NGN <?= number_format($payroll['total_amount'], 2) ?></td>
                        <td><span class="badge badge-<?= $payroll['status'] === 'processed' ? 'success' : ($payroll['status'] === 'pending' ? 'warning' : 'secondary') ?>"><?= ucfirst($payroll['status']) ?></span></td>
                        <td><?= date('M j, Y', strtotime($payroll['created_at'])) ?></td>
                        <td><a href="<?= base_url('admin/payroll/' . $payroll['id']) ?>" class="btn btn-sm btn-outline">View</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
