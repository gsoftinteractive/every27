<?php
// Set default userType based on session or URL if not provided
if (!isset($userType)) {
    if (session()->get('admin_id')) {
        $userType = 'admin';
    } elseif (session()->get('company_id')) {
        $userType = 'company';
    } elseif (session()->get('employee_id')) {
        $userType = 'employee';
    } else {
        $userType = 'user';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Dashboard' ?> | Every27</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= base_url('assets/images/every27.svg') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Dashboard Styles -->
    <style>
        :root {
            --primary: #0E84F1;
            --primary-dark: #0b6bc5;
            --secondary: #DFEBF7;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
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
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            line-height: 1.5;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: white;
            border-right: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--gray-200);
        }

        .sidebar-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            text-decoration: none;
        }

        .sidebar-logo span {
            color: var(--primary);
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 20px;
        }

        .nav-section-title {
            padding: 0 20px;
            margin-bottom: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            color: var(--gray-600);
            text-decoration: none;
            transition: all 0.2s;
        }

        .nav-link:hover {
            background: var(--gray-50);
            color: var(--gray-900);
        }

        .nav-link.active {
            background: var(--secondary);
            color: var(--primary);
            font-weight: 500;
        }

        .nav-link svg {
            width: 20px;
            height: 20px;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--gray-200);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.875rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--gray-500);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .content {
            padding: 24px;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-weight: 600;
            font-size: 1rem;
        }

        .card-body {
            padding: 20px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            padding: 20px;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--gray-500);
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .stat-change {
            font-size: 0.875rem;
            margin-top: 8px;
        }

        .stat-change.positive {
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--danger);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--gray-300);
            color: var(--gray-700);
        }

        .btn-outline:hover {
            background: var(--gray-50);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        /* Tables */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        th {
            font-weight: 600;
            font-size: 0.75rem;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            font-size: 0.875rem;
        }

        tbody tr:hover {
            background: var(--gray-50);
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 100px;
        }

        .badge-success {
            background: #D1FAE5;
            color: #065F46;
        }

        .badge-warning {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge-danger {
            background: #FEE2E2;
            color: #B91C1C;
        }

        .badge-info {
            background: var(--secondary);
            color: var(--primary);
        }

        /* Alerts */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
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

        .alert-warning {
            background: #FEF3C7;
            color: #92400E;
            border: 1px solid #F59E0B;
        }

        /* Forms */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            font-size: 0.875rem;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            border-color: var(--primary);
        }

        /* Grid */
        .grid {
            display: grid;
            gap: 20px;
        }

        .grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="<?= base_url() ?>" class="sidebar-logo">
                Every<span>27</span>
            </a>
        </div>

        <nav class="sidebar-nav">
            <?= $this->renderSection('sidebar') ?>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <?= strtoupper(substr(session()->get($userType . '_name') ?? 'U', 0, 1)) ?>
                </div>
                <div class="user-details">
                    <div class="user-name"><?= session()->get($userType . '_name') ?? 'User' ?></div>
                    <div class="user-role"><?= ucfirst($userType ?? 'User') ?></div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="topbar">
            <h1 class="page-title"><?= $pageTitle ?? 'Dashboard' ?></h1>
            <div class="topbar-actions">
                <a href="<?= base_url($userType . '/logout') ?>" class="btn btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </a>
            </div>
        </header>

        <div class="content">
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

            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
