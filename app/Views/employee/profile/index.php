<?= $this->extend('layouts/dashboard') ?>

<?php $userType = 'employee'; ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">
    <div class="nav-section-title">Overview</div>
    <a href="<?= base_url('employee/dashboard') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        Dashboard
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Money</div>
    <a href="<?= base_url('employee/wallet') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
        My Wallet
    </a>
    <a href="<?= base_url('employee/advance') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        Salary Advance
    </a>
    <a href="<?= base_url('employee/payslips') ?>" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
        Payslips
    </a>
</div>
<div class="nav-section">
    <div class="nav-section-title">Account</div>
    <a href="<?= base_url('employee/profile') ?>" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        My Profile
    </a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="grid grid-2">
    <!-- Personal Information -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('employee/profile/update') ?>" method="POST">
                <?= csrf_field() ?>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" class="form-input" value="<?= esc($employee['first_name']) ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" class="form-input" value="<?= esc($employee['last_name']) ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" class="form-input" value="<?= esc($employee['email']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="form-input" value="<?= esc($employee['phone']) ?>">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" id="department" class="form-input" value="<?= esc($employee['department']) ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" id="position" class="form-input" value="<?= esc($employee['position']) ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="monthly_salary" class="form-label">Monthly Salary</label>
                    <input type="text" id="monthly_salary" class="form-input" value="₦<?= number_format($employee['monthly_salary'], 2) ?>" disabled>
                </div>

                <div style="margin-top: 24px;">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bank Details & Password -->
    <div>
        <!-- Bank Details -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Bank Details</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('employee/profile/bank') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="bank_name" class="form-label">Bank Name *</label>
                        <select id="bank_name" name="bank_name" class="form-input" required>
                            <option value="">Select Bank</option>
                            <?php
                            $banks = ['Access Bank', 'Citibank', 'Ecobank', 'Fidelity Bank', 'First Bank', 'First City Monument Bank', 'Globus Bank', 'Guaranty Trust Bank', 'Heritage Bank', 'Keystone Bank', 'Kuda Bank', 'Opay', 'Palmpay', 'Polaris Bank', 'Providus Bank', 'Stanbic IBTC Bank', 'Standard Chartered Bank', 'Sterling Bank', 'Titan Trust Bank', 'Union Bank', 'United Bank for Africa', 'Unity Bank', 'Wema Bank', 'Zenith Bank'];
                            foreach ($banks as $bank):
                            ?>
                                <option value="<?= $bank ?>" <?= $employee['bank_name'] === $bank ? 'selected' : '' ?>><?= $bank ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="account_number" class="form-label">Account Number *</label>
                        <input type="text" id="account_number" name="account_number" class="form-input" value="<?= esc($employee['account_number']) ?>" maxlength="10" pattern="[0-9]{10}" required>
                    </div>

                    <div class="form-group">
                        <label for="account_name" class="form-label">Account Name</label>
                        <input type="text" id="account_name" name="account_name" class="form-input" value="<?= esc($employee['account_name'] ?? '') ?>" placeholder="Account holder name">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Bank Details</button>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3 class="card-title">Change Password</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('employee/profile/password') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="current_password" class="form-label">Current Password *</label>
                        <input type="password" id="current_password" name="current_password" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password" class="form-label">New Password *</label>
                        <input type="password" id="new_password" name="new_password" class="form-input" minlength="8" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password" class="form-label">Confirm New Password *</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-input" minlength="8" required>
                    </div>

                    <button type="submit" class="btn btn-outline">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
