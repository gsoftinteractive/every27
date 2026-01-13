<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Login' ?> | Every27</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= base_url('assets/images/every27.svg') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0E84F1;
            --primary-dark: #0b6bc5;
            --secondary: #DFEBF7;
            --gray-50: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --gray-800: #1F2937;
            --gray-900: #111827;
            --success: #10B981;
            --danger: #EF4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, #0b6bc5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
        }

        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .auth-header {
            text-align: center;
            padding: 32px 32px 24px;
        }

        .auth-logo {
            text-decoration: none;
            display: inline-block;
            margin-bottom: 8px;
        }

        .auth-logo img {
            height: 40px;
            width: auto;
        }

        .auth-subtitle {
            color: var(--gray-500);
            font-size: 0.9375rem;
        }

        .auth-type {
            background: var(--secondary);
            color: var(--primary);
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-block;
            margin-bottom: 16px;
        }

        .auth-body {
            padding: 0 32px 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            font-size: 0.9375rem;
            border: 1px solid var(--gray-300);
            border-radius: 10px;
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 132, 241, 0.1);
        }

        .form-input.error {
            border-color: var(--danger);
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
            color: var(--gray-600);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.875rem;
            color: var(--primary);
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px 24px;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .auth-footer {
            text-align: center;
            padding: 20px 32px;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
        }

        .auth-footer p {
            font-size: 0.875rem;
            color: var(--gray-500);
        }

        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            color: white;
            text-decoration: none;
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .back-link:hover {
            opacity: 1;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.875rem;
        }

        .alert-success {
            background: #D1FAE5;
            color: #065F46;
            border: 1px solid #10B981;
        }

        .alert-error {
            background: #FEE2E2;
            color: #B91C1C;
            border: 1px solid #EF4444;
        }

        .error-text {
            color: var(--danger);
            font-size: 0.8125rem;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <a href="<?= base_url() ?>" class="auth-logo">
                    <img src="<?= base_url('assets/images/every27.svg') ?>" alt="Every27 Logo">
                </a>
                <?php if (isset($authType)): ?>
                    <div class="auth-type"><?= $authType ?> Portal</div>
                <?php endif; ?>
                <p class="auth-subtitle"><?= $subtitle ?? 'Sign in to your account' ?></p>
            </div>

            <div class="auth-body">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-error">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-error">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <div><?= $error ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('form') ?>
            </div>

            <div class="auth-footer">
                <?= $this->renderSection('footer') ?>
            </div>
        </div>

        <a href="<?= base_url() ?>" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Home
        </a>
    </div>
</body>
</html>
