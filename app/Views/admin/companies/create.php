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
    <a href="<?= base_url('admin/access-requests') ?>" class="nav-link">Access Requests</a>
    <a href="<?= base_url('admin/companies') ?>" class="nav-link active">Companies</a>
    <a href="<?= base_url('admin/employees') ?>" class="nav-link">Employees</a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Finance</div>
    <a href="<?= base_url('admin/transactions') ?>" class="nav-link">Transactions</a>
    <a href="<?= base_url('admin/withdrawals') ?>" class="nav-link">Withdrawals</a>
    <a href="<?= base_url('admin/fundings') ?>" class="nav-link">Fundings</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div style="margin-bottom: 24px;">
    <a href="<?= base_url('admin/companies') ?>" class="btn btn-outline">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Back to Companies
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create New Company</h3>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error" style="margin-bottom: 20px;">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <div><?= esc($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/companies/create') ?>" method="POST">
            <?= csrf_field() ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Company Name *</label>
                    <input type="text" name="company_name" class="form-input" value="<?= old('company_name') ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-input" value="<?= old('email') ?>" required>
                    <small style="color: var(--gray-500);">This will be the company's login email</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number *</label>
                    <input type="text" name="phone" class="form-input" value="<?= old('phone') ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Contact Person *</label>
                    <input type="text" name="contact_person" class="form-input" value="<?= old('contact_person') ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-input" required minlength="8">
                    <small style="color: var(--gray-500);">Minimum 8 characters</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Industry</label>
                    <select name="industry" class="form-input">
                        <option value="">Select Industry</option>
                        <option value="Technology" <?= old('industry') === 'Technology' ? 'selected' : '' ?>>Technology</option>
                        <option value="Finance" <?= old('industry') === 'Finance' ? 'selected' : '' ?>>Finance</option>
                        <option value="Healthcare" <?= old('industry') === 'Healthcare' ? 'selected' : '' ?>>Healthcare</option>
                        <option value="Education" <?= old('industry') === 'Education' ? 'selected' : '' ?>>Education</option>
                        <option value="Manufacturing" <?= old('industry') === 'Manufacturing' ? 'selected' : '' ?>>Manufacturing</option>
                        <option value="Retail" <?= old('industry') === 'Retail' ? 'selected' : '' ?>>Retail</option>
                        <option value="Services" <?= old('industry') === 'Services' ? 'selected' : '' ?>>Services</option>
                        <option value="Other" <?= old('industry') === 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-input" rows="2"><?= old('address') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Monthly Fee Per Employee (NGN)</label>
                    <input type="number" name="monthly_fee" class="form-input" value="<?= old('monthly_fee', '500') ?>" step="0.01">
                </div>
            </div>

            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Create Company
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
