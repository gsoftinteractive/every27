<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">Dashboard</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Settings</div>
    <a href="<?= base_url('admin/users') ?>" class="nav-link">Admin Users</a>
    <a href="<?= base_url('admin/settings') ?>" class="nav-link active">Platform Settings</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Platform Settings</h3>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/settings') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label class="form-label">Platform Name</label>
                <input type="text" name="platform_name" class="form-input" value="<?= esc($settings['platform_name'] ?? 'Every27') ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Default Monthly Fee Per Employee (NGN)</label>
                <input type="number" name="default_fee_per_employee" class="form-input" value="<?= esc($settings['default_fee_per_employee'] ?? '500') ?>" step="0.01">
            </div>

            <div class="form-group">
                <label class="form-label">Maximum Advance Percentage (%)</label>
                <input type="number" name="max_advance_percentage" class="form-input" value="<?= esc($settings['max_advance_percentage'] ?? '50') ?>" min="0" max="100">
            </div>

            <div class="form-group">
                <label class="form-label">Platform Bank Name</label>
                <input type="text" name="platform_bank_name" class="form-input" value="<?= esc($settings['platform_bank_name'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Platform Account Number</label>
                <input type="text" name="platform_account_number" class="form-input" value="<?= esc($settings['platform_account_number'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Platform Account Name</label>
                <input type="text" name="platform_account_name" class="form-input" value="<?= esc($settings['platform_account_name'] ?? '') ?>">
            </div>

            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
