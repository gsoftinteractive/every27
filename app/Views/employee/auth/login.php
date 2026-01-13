<?= $this->extend('layouts/auth') ?>

<?php
$authType = 'Employee';
$subtitle = 'Access your salary and wallet';
?>

<?= $this->section('form') ?>
<form action="<?= base_url('employee/login') ?>" method="POST">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" id="email" name="email" class="form-input" placeholder="you@example.com" value="<?= old('email') ?>" required>
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required>
    </div>

    <div class="form-footer">
        <label class="checkbox-label">
            <input type="checkbox" name="remember">
            Remember me
        </label>
        <a href="<?= base_url('employee/forgot-password') ?>" class="forgot-link">Forgot password?</a>
    </div>

    <button type="submit" class="btn btn-primary">
        Sign In
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
    </button>
</form>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<p>Your company should provide your login credentials.</p>
<?= $this->endSection() ?>
