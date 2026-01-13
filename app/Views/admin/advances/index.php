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
    <a href="<?= base_url('admin/companies') ?>" class="nav-link">Companies</a>
    <a href="<?= base_url('admin/employees') ?>" class="nav-link">Employees</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('admin/transactions') ?>" class="nav-link">Transactions</a>
    <a href="<?= base_url('admin/advances') ?>" class="nav-link active">Salary Advances</a>
    <a href="<?= base_url('admin/withdrawals') ?>" class="nav-link">Withdrawals</a>
    <a href="<?= base_url('admin/fundings') ?>" class="nav-link">Fundings</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div style="display: flex; gap: 12px; margin-bottom: 24px;">
    <a href="<?= base_url('admin/advances') ?>" class="btn <?= empty($currentStatus) ? 'btn-primary' : 'btn-outline' ?>">All (<?= $counts['total'] ?>)</a>
    <a href="<?= base_url('admin/advances?status=pending') ?>" class="btn <?= $currentStatus === 'pending' ? 'btn-primary' : 'btn-outline' ?>">Pending (<?= $counts['pending'] ?>)</a>
    <a href="<?= base_url('admin/advances?status=approved') ?>" class="btn <?= $currentStatus === 'approved' ? 'btn-primary' : 'btn-outline' ?>">Approved (<?= $counts['approved'] ?>)</a>
    <a href="<?= base_url('admin/advances?status=disbursed') ?>" class="btn <?= $currentStatus === 'disbursed' ? 'btn-primary' : 'btn-outline' ?>">Disbursed (<?= $counts['disbursed'] ?>)</a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($advances)): ?>
            <p style="text-align: center; color: var(--gray-500); padding: 40px;">No salary advances found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Company</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Requested</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($advances as $adv): ?>
                    <tr>
                        <td><?= esc($adv['first_name'] . ' ' . $adv['last_name']) ?></td>
                        <td><?= esc($adv['company_name']) ?></td>
                        <td>NGN <?= number_format($adv['amount'], 2) ?></td>
                        <td><span class="badge badge-<?= $adv['status'] === 'approved' ? 'success' : ($adv['status'] === 'pending' ? 'warning' : 'secondary') ?>"><?= ucfirst($adv['status']) ?></span></td>
                        <td><?= date('M j, Y', strtotime($adv['created_at'])) ?></td>
                        <td><a href="<?= base_url('admin/advances/' . $adv['id']) ?>" class="btn btn-sm btn-outline">View</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
