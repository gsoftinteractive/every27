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
<a href="<?= base_url('admin/users') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Admin Users
</a>

<div class="card" style="max-width: 600px;">
    <div class="card-header">
        <h3 class="card-title">Create Admin User</h3>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error" style="margin-bottom: 20px;">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <div><?= esc($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/users/create') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-input" value="<?= old('name') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-input" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password *</label>
                <input type="password" name="password" class="form-input" required minlength="8">
                <small style="color: var(--gray-500);">Minimum 8 characters</small>
            </div>

            <div class="form-group">
                <label class="form-label">Role *</label>
                <select name="role" class="form-input" required>
                    <option value="">Select Role</option>
                    <option value="super_admin" <?= old('role') === 'super_admin' ? 'selected' : '' ?>>Super Admin</option>
                    <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="support" <?= old('role') === 'support' ? 'selected' : '' ?>>Support</option>
                </select>
            </div>

            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
                <button type="submit" class="btn btn-primary">Create Admin User</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
