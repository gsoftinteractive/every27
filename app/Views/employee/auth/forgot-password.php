<?= $this->extend('layouts/auth') ?>

<?php
$authType = 'Employee';
$subtitle = 'Reset your password';
?>

<?= $this->section('form') ?>
<form action="<?= base_url('employee/forgot-password') ?>" method="POST">
    <?= csrf_field() ?>

    <p style="color: var(--gray-600); margin-bottom: 20px;">
        Enter your email address and we'll send you a link to reset your password.
    </p>

    <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" id="email" name="email" class="form-input" placeholder="you@example.com" value="<?= old('email') ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">
        Send Reset Link
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="22" y1="2" x2="11" y2="13"></line>
            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
        </svg>
    </button>
</form>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<p><a href="<?= base_url('employee/login') ?>">Back to Login</a></p>
<?= $this->endSection() ?>
