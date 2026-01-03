<?php
/**
 * Every27 - Security Page
 */

$page_title = 'Security';
$page_description = 'Learn about Every27\'s security measures. We protect your data with bank-grade encryption and two-factor authentication.';

include '../includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span class="current">Security</span>
        </div>
        <h1>Security at Every27</h1>
        <p>Your security is our top priority. Learn how we protect your data and funds.</p>
    </div>
</section>

<!-- Security Content -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Our Commitment</span>
            <h2 class="section-title">Bank-Grade Security for Your Peace of Mind</h2>
            <p class="section-description">
                We implement industry-leading security measures to ensure your data and funds are always protected.
            </p>
        </div>

        <div class="grid grid-3 mb-5">
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Data Encryption</h3>
                <p class="feature-description">
                    All data is encrypted in transit using SSL/TLS and at rest using AES-256 encryption. Your sensitive information is always protected.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Two-Factor Authentication</h3>
                <p class="feature-description">
                    Every login requires a verification code sent to your email. This ensures only you can access your account.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </div>
                <h3 class="feature-title">Activity Monitoring</h3>
                <p class="feature-description">
                    We monitor all account activity for suspicious behavior and alert you immediately if anything unusual is detected.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="3" y1="9" x2="21" y2="9"></line>
                        <line x1="9" y1="21" x2="9" y2="9"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Secure Infrastructure</h3>
                <p class="feature-description">
                    Our platform runs on enterprise-grade cloud infrastructure with redundancy, regular backups, and disaster recovery.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Regular Audits</h3>
                <p class="feature-description">
                    We conduct regular security audits and penetration testing to identify and address potential vulnerabilities.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Access Controls</h3>
                <p class="feature-description">
                    Strict role-based access controls ensure only authorized personnel can access sensitive data and systems.
                </p>
            </div>
        </div>

        <div class="card reveal" style="max-width: 800px; margin: 0 auto;">
            <div class="card-body">
                <h3 style="margin-bottom: var(--spacing-lg);">Report a Security Issue</h3>
                <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    If you discover a security vulnerability or suspicious activity, please report it immediately. We take all reports seriously and will investigate promptly.
                </p>
                <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
                    <a href="mailto:security@every27.com" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        security@every27.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
