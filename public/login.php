<?php
/**
 * Every27 - Login Page
 * User authentication page
 */

$page_title = 'Login';
$page_description = 'Login to your Every27 account. Secure access for companies and employees.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $page_title; ?> | Every27</title>
    <meta name="description" content="<?php echo $page_description; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="assets/images/every27.svg">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-page">
        <div class="login-container">
            <div class="login-card">
                <!-- Header -->
                <div class="login-header">
                    <a href="/" class="logo">
                        <span>Every</span><span class="highlight">27</span>
                    </a>
                    <p style="color: var(--gray-500); margin-bottom: 0;">Welcome back! Please login to your account.</p>
                </div>

                <!-- Login Tabs -->
                <div class="login-tabs">
                    <button class="login-tab active" data-tab="company">Company</button>
                    <button class="login-tab" data-tab="employee">Employee</button>
                </div>

                <!-- Company Login Form -->
                <form id="company-form" class="login-form" action="#" method="POST" data-validate>
                    <div class="form-group">
                        <label for="company_email" class="form-label">Email Address</label>
                        <input type="email" id="company_email" name="email" class="form-input" placeholder="you@company.com" required>
                    </div>

                    <div class="form-group">
                        <label for="company_password" class="form-label">Password</label>
                        <div style="position: relative;">
                            <input type="password" id="company_password" name="password" class="form-input" placeholder="Enter your password" required style="padding-right: 48px;">
                            <button type="button" class="password-toggle" onclick="togglePassword('company_password')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--gray-400); cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-lg);">
                        <label style="display: flex; align-items: center; gap: var(--spacing-sm); cursor: pointer; font-size: 0.875rem; color: var(--gray-600);">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                        <a href="#" style="font-size: 0.875rem;">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Login
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

                <!-- Employee Login Form -->
                <form id="employee-form" class="login-form" action="#" method="POST" data-validate style="display: none;">
                    <div class="form-group">
                        <label for="employee_email" class="form-label">Email Address</label>
                        <input type="email" id="employee_email" name="email" class="form-input" placeholder="you@example.com" required>
                    </div>

                    <div class="form-group">
                        <label for="employee_password" class="form-label">Password</label>
                        <div style="position: relative;">
                            <input type="password" id="employee_password" name="password" class="form-input" placeholder="Enter your password" required style="padding-right: 48px;">
                            <button type="button" class="password-toggle" onclick="togglePassword('employee_password')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--gray-400); cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-lg);">
                        <label style="display: flex; align-items: center; gap: var(--spacing-sm); cursor: pointer; font-size: 0.875rem; color: var(--gray-600);">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                        <a href="#" style="font-size: 0.875rem;">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Login
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

                <!-- Footer -->
                <div class="login-footer">
                    <p style="color: var(--gray-500); margin-bottom: var(--spacing-sm);">Don't have an account?</p>
                    <a href="request-access.php" class="btn btn-outline btn-block">Request Company Access</a>
                </div>
            </div>

            <!-- Back to Home -->
            <div style="text-align: center; margin-top: var(--spacing-lg);">
                <a href="/" style="color: var(--gray-500); font-size: 0.875rem; display: inline-flex; align-items: center; gap: var(--spacing-sm);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script>
        // Tab switching
        const tabs = document.querySelectorAll('.login-tab');
        const companyForm = document.getElementById('company-form');
        const employeeForm = document.getElementById('employee-form');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Update active tab
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Show/hide forms
                if (this.dataset.tab === 'company') {
                    companyForm.style.display = 'block';
                    employeeForm.style.display = 'none';
                } else {
                    companyForm.style.display = 'none';
                    employeeForm.style.display = 'block';
                }
            });
        });

        // Password toggle
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const toggle = input.parentElement.querySelector('.password-toggle');

            if (input.type === 'password') {
                input.type = 'text';
                toggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
            } else {
                input.type = 'password';
                toggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            }
        }
    </script>
</body>
</html>
