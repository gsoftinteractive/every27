<?php
/**
 * Every27 - Header Template
 * Shared header component for all public pages
 */

// Get current page for active nav highlighting
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO Meta Tags -->
    <title><?php echo isset($page_title) ? $page_title . ' | Every27' : 'Every27 - Your Salary, On Time, Every Time'; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Every27 is a modern payroll platform ensuring employees receive their salaries on the 27th of every month. Solving late and erratic salary payments in Africa.'; ?>">
    <meta name="keywords" content="payroll, salary, Nigeria, Africa, employee payment, salary advance, automated payroll, Every27">
    <meta name="author" content="Every27 Limited">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://every27.com/">
    <meta property="og:title" content="<?php echo isset($page_title) ? $page_title . ' | Every27' : 'Every27 - Your Salary, On Time, Every Time'; ?>">
    <meta property="og:description" content="<?php echo isset($page_description) ? $page_description : 'Every27 is a modern payroll platform ensuring employees receive their salaries on the 27th of every month.'; ?>">
    <meta property="og:image" content="https://every27.com/assets/images/og-image.jpg">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($page_title) ? $page_title . ' | Every27' : 'Every27 - Your Salary, On Time, Every Time'; ?>">
    <meta name="twitter:description" content="<?php echo isset($page_description) ? $page_description : 'Every27 is a modern payroll platform ensuring employees receive their salaries on the 27th of every month.'; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="assets/images/every27.svg">
    <link rel="apple-touch-icon" href="assets/images/every27.svg">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/style.css">
    <?php if (isset($extra_css)): ?>
        <?php foreach ($extra_css as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="header-inner">
            <!-- Logo -->
            <a href="index.php" class="logo">
                <img src="assets/images/every27.svg" alt="Every27 Logo">
            </a>

            <!-- Desktop Navigation -->
            <nav class="nav-desktop">
                <ul class="nav-links">
                    <li><a href="index.php" class="nav-link <?php echo $current_page == 'index' ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="about.php" class="nav-link <?php echo $current_page == 'about' ? 'active' : ''; ?>">About</a></li>
                    <li><a href="features.php" class="nav-link <?php echo $current_page == 'features' ? 'active' : ''; ?>">Features</a></li>
                    <li><a href="pricing.php" class="nav-link <?php echo $current_page == 'pricing' ? 'active' : ''; ?>">Pricing</a></li>
                    <li><a href="faq.php" class="nav-link <?php echo $current_page == 'faq' ? 'active' : ''; ?>">FAQs</a></li>
                    <li><a href="contact.php" class="nav-link <?php echo $current_page == 'contact' ? 'active' : ''; ?>">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="login.php" class="btn btn-outline">Login</a>
                    <a href="request-access.php" class="btn btn-primary">Request Access</a>
                </div>
            </nav>

            <!-- Mobile Navigation Toggle -->
            <button class="nav-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav class="nav-mobile">
            <ul class="nav-links">
                <li><a href="index.php" class="nav-link <?php echo $current_page == 'index' ? 'active' : ''; ?>">Home</a></li>
                <li><a href="about.php" class="nav-link <?php echo $current_page == 'about' ? 'active' : ''; ?>">About</a></li>
                <li><a href="features.php" class="nav-link <?php echo $current_page == 'features' ? 'active' : ''; ?>">Features</a></li>
                <li><a href="pricing.php" class="nav-link <?php echo $current_page == 'pricing' ? 'active' : ''; ?>">Pricing</a></li>
                <li><a href="faq.php" class="nav-link <?php echo $current_page == 'faq' ? 'active' : ''; ?>">FAQs</a></li>
                <li><a href="contact.php" class="nav-link <?php echo $current_page == 'contact' ? 'active' : ''; ?>">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <a href="login.php" class="btn btn-outline">Login</a>
                <a href="request-access.php" class="btn btn-primary">Request Access</a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
