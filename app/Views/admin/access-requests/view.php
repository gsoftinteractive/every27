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
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg>
        Access Requests
    </a>
    <a href="<?= base_url('admin/companies') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
        Companies
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('admin/access-requests') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Requests
</a>

<div class="grid grid-2" style="max-width: 1000px;">
    <!-- Request Details -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Request Details</h3>
            <span class="badge badge-<?= $request['status'] === 'pending' ? 'warning' : ($request['status'] === 'approved' ? 'success' : ($request['status'] === 'contacted' ? 'info' : 'danger')) ?>">
                <?= ucfirst($request['status']) ?>
            </span>
        </div>
        <div class="card-body">
            <table style="width: 100%;">
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">Company Name</td>
                    <td style="padding: 8px 0; font-weight: 500;"><?= esc($request['company_name']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">RC/CAC Number</td>
                    <td style="padding: 8px 0;"><?= esc($request['rc_number']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">Industry</td>
                    <td style="padding: 8px 0;"><?= esc($request['industry'] ?: 'Not specified') ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">Employees</td>
                    <td style="padding: 8px 0;"><?= esc($request['employee_count']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">Address</td>
                    <td style="padding: 8px 0;"><?= esc($request['address']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">Submitted</td>
                    <td style="padding: 8px 0;"><?= date('F j, Y g:ia', strtotime($request['created_at'])) ?></td>
                </tr>
            </table>

            <?php if ($request['message']): ?>
                <div style="margin-top: 20px; padding: 16px; background: var(--gray-50); border-radius: 8px;">
                    <strong style="display: block; margin-bottom: 8px;">Additional Message:</strong>
                    <?= nl2br(esc($request['message'])) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Contact Person -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contact Person</h3>
        </div>
        <div class="card-body">
            <table style="width: 100%;">
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">Name</td>
                    <td style="padding: 8px 0; font-weight: 500;"><?= esc($request['contact_name']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">Position</td>
                    <td style="padding: 8px 0;"><?= esc($request['position']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">Email</td>
                    <td style="padding: 8px 0;"><a href="mailto:<?= esc($request['email']) ?>"><?= esc($request['email']) ?></a></td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--gray-500);">Phone</td>
                    <td style="padding: 8px 0;"><a href="tel:<?= esc($request['phone']) ?>"><?= esc($request['phone']) ?></a></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Actions -->
<?php if ($request['status'] === 'pending' || $request['status'] === 'contacted'): ?>
<div class="card" style="margin-top: 20px; max-width: 1000px;">
    <div class="card-header">
        <h3 class="card-title">Actions</h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <?php if ($request['status'] === 'pending'): ?>
            <!-- Mark as Contacted -->
            <form action="<?= base_url('admin/access-requests/' . $request['id'] . '/contact') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label class="form-label">Mark as Contacted</label>
                    <textarea name="notes" class="form-input" rows="2" placeholder="Contact notes (optional)"></textarea>
                </div>
                <button type="submit" class="btn btn-outline" style="width: 100%;">Mark Contacted</button>
            </form>
            <?php endif; ?>

            <!-- Approve -->
            <form action="<?= base_url('admin/access-requests/' . $request['id'] . '/approve') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label class="form-label">Approve & Create Company</label>
                    <input type="password" name="password" class="form-input" placeholder="Set initial password" required minlength="8">
                    <small style="color: var(--gray-500);">Min. 8 characters</small>
                </div>
                <button type="submit" class="btn btn-success" style="width: 100%;">Approve</button>
            </form>

            <!-- Reject -->
            <form action="<?= base_url('admin/access-requests/' . $request['id'] . '/reject') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label class="form-label">Reject Request</label>
                    <textarea name="reason" class="form-input" rows="2" placeholder="Rejection reason" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger" style="width: 100%;">Reject</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?= $this->endSection() ?>
