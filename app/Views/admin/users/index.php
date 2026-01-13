<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">Dashboard</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Settings</div>
    <a href="<?= base_url('admin/users') ?>" class="nav-link active">Admin Users</a>
    <a href="<?= base_url('admin/settings') ?>" class="nav-link">Platform Settings</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3 class="card-title">Admin Users</h3>
        <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary">Add Admin</a>
    </div>
    <div class="card-body">
        <?php if (empty($admins)): ?>
            <p style="text-align: center; color: var(--gray-500); padding: 40px;">No admin users found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?= esc($admin['name']) ?></td>
                        <td><?= esc($admin['email']) ?></td>
                        <td><span class="badge badge-primary"><?= ucfirst(str_replace('_', ' ', $admin['role'])) ?></span></td>
                        <td><span class="badge badge-<?= $admin['status'] === 'active' ? 'success' : 'danger' ?>"><?= ucfirst($admin['status']) ?></span></td>
                        <td><?= date('M j, Y', strtotime($admin['created_at'])) ?></td>
                        <td>
                            <a href="<?= base_url('admin/users/' . $admin['id']) ?>" class="btn btn-sm btn-outline">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
