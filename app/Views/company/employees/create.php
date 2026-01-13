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
    <a href="<?= base_url('company/employees') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
        Manage Employees
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a href="<?= base_url('company/employees') ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-600); text-decoration: none; margin-bottom: 20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Back to Employees
</a>

<div class="card" style="max-width: 700px;">
    <div class="card-header">
        <h3 class="card-title">Add New Employee</h3>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <div><?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('company/employees/create') ?>" method="POST">
            <?= csrf_field() ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label for="first_name" class="form-label">First Name *</label>
                    <input type="text" id="first_name" name="first_name" class="form-input" value="<?= old('first_name') ?>" required>
                </div>

                <div class="form-group">
                    <label for="last_name" class="form-label">Last Name *</label>
                    <input type="text" id="last_name" name="last_name" class="form-input" value="<?= old('last_name') ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" id="email" name="email" class="form-input" value="<?= old('email') ?>" required>
                <small style="color: var(--gray-500);">Login credentials will be sent to this email</small>
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-input" value="<?= old('phone') ?>">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" id="department" name="department" class="form-input" value="<?= old('department') ?>">
                </div>

                <div class="form-group">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" id="position" name="position" class="form-input" value="<?= old('position') ?>">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label for="monthly_salary" class="form-label">Monthly Salary (₦) *</label>
                    <input type="number" id="monthly_salary" name="monthly_salary" class="form-input" value="<?= old('monthly_salary') ?>" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="hire_date" class="form-label">Hire Date</label>
                    <input type="date" id="hire_date" name="hire_date" class="form-input" value="<?= old('hire_date') ?: date('Y-m-d') ?>">
                </div>
            </div>

            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add Employee
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
