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
    <a href="<?= base_url('admin/access-requests') ?>" class="nav-link active">
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
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Status Tabs -->
<div style="display: flex; gap: 8px; margin-bottom: 20px;">
    <a href="<?= base_url('admin/access-requests') ?>" class="btn <?= !$currentStatus ? 'btn-primary' : 'btn-outline' ?>">
        All (<?= array_sum($counts) ?>)
    </a>
    <a href="<?= base_url('admin/access-requests?status=pending') ?>" class="btn <?= $currentStatus === 'pending' ? 'btn-primary' : 'btn-outline' ?>">
        Pending (<?= $counts['pending'] ?>)
    </a>
    <a href="<?= base_url('admin/access-requests?status=contacted') ?>" class="btn <?= $currentStatus === 'contacted' ? 'btn-primary' : 'btn-outline' ?>">
        Contacted (<?= $counts['contacted'] ?>)
    </a>
    <a href="<?= base_url('admin/access-requests?status=approved') ?>" class="btn <?= $currentStatus === 'approved' ? 'btn-primary' : 'btn-outline' ?>">
        Approved (<?= $counts['approved'] ?>)
    </a>
    <a href="<?= base_url('admin/access-requests?status=rejected') ?>" class="btn <?= $currentStatus === 'rejected' ? 'btn-primary' : 'btn-outline' ?>">
        Rejected (<?= $counts['rejected'] ?>)
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Access Requests</h3>
    </div>
    <div class="card-body">
        <?php if (empty($requests)): ?>
            <p style="color: var(--gray-500); text-align: center; padding: 40px;">No requests found</p>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Employees</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $request): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($request['company_name']) ?></strong>
                                    <div style="font-size: 0.75rem; color: var(--gray-500);">RC: <?= esc($request['rc_number']) ?></div>
                                </td>
                                <td>
                                    <?= esc($request['contact_name']) ?>
                                    <div style="font-size: 0.75rem; color: var(--gray-500);"><?= esc($request['position']) ?></div>
                                </td>
                                <td><?= esc($request['email']) ?></td>
                                <td><?= esc($request['phone']) ?></td>
                                <td><?= esc($request['employee_count']) ?></td>
                                <td>
                                    <span class="badge badge-<?= $request['status'] === 'pending' ? 'warning' : ($request['status'] === 'approved' ? 'success' : ($request['status'] === 'contacted' ? 'info' : 'danger')) ?>">
                                        <?= ucfirst($request['status']) ?>
                                    </span>
                                </td>
                                <td><?= date('M j, Y', strtotime($request['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/access-requests/' . $request['id']) ?>" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.75rem;">View</a>
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
