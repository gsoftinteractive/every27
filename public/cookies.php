<?php
/**
 * Every27 - Cookie Policy Page
 */

$page_title = 'Cookie Policy';
$page_description = 'Learn about how Every27 uses cookies to improve your experience on our platform.';

include '../includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span class="current">Cookie Policy</span>
        </div>
        <h1>Cookie Policy</h1>
        <p>Last updated: January 2026</p>
    </div>
</section>

<!-- Cookie Policy Content -->
<section class="section">
    <div class="container">
        <div class="card" style="max-width: 900px; margin: 0 auto;">
            <div class="card-body" style="padding: var(--spacing-2xl);">

                <div style="color: var(--gray-600); line-height: 1.8;">

                    <h2>What Are Cookies?</h2>
                    <p>
                        Cookies are small text files that are placed on your device when you visit a website. They are widely used to make websites work more efficiently and provide information to website owners.
                    </p>

                    <h2>How We Use Cookies</h2>
                    <p>Every27 uses cookies for the following purposes:</p>

                    <h3>Essential Cookies</h3>
                    <p>
                        These cookies are necessary for the website to function properly. They enable core functionality such as:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>User authentication and session management</li>
                        <li>Security features and fraud prevention</li>
                        <li>Remembering your preferences</li>
                        <li>Two-factor authentication</li>
                    </ul>

                    <h3>Performance Cookies</h3>
                    <p>
                        These cookies help us understand how visitors interact with our website by collecting anonymous information:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Pages visited and time spent</li>
                        <li>Error messages encountered</li>
                        <li>Load times and performance metrics</li>
                    </ul>

                    <h3>Functional Cookies</h3>
                    <p>
                        These cookies enable enhanced functionality and personalization:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Language preferences</li>
                        <li>Region settings</li>
                        <li>User interface customizations</li>
                    </ul>

                    <h2>Cookies We Use</h2>

                    <table style="width: 100%; margin: var(--spacing-lg) 0;">
                        <thead>
                            <tr>
                                <th style="text-align: left; padding: var(--spacing-sm);">Cookie Name</th>
                                <th style="text-align: left; padding: var(--spacing-sm);">Purpose</th>
                                <th style="text-align: left; padding: var(--spacing-sm);">Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: var(--spacing-sm); border-bottom: 1px solid var(--gray-200);">session_id</td>
                                <td style="padding: var(--spacing-sm); border-bottom: 1px solid var(--gray-200);">User session management</td>
                                <td style="padding: var(--spacing-sm); border-bottom: 1px solid var(--gray-200);">Session</td>
                            </tr>
                            <tr>
                                <td style="padding: var(--spacing-sm); border-bottom: 1px solid var(--gray-200);">remember_me</td>
                                <td style="padding: var(--spacing-sm); border-bottom: 1px solid var(--gray-200);">Keep user logged in</td>
                                <td style="padding: var(--spacing-sm); border-bottom: 1px solid var(--gray-200);">30 days</td>
                            </tr>
                            <tr>
                                <td style="padding: var(--spacing-sm); border-bottom: 1px solid var(--gray-200);">csrf_token</td>
                                <td style="padding: var(--spacing-sm); border-bottom: 1px solid var(--gray-200);">Security protection</td>
                                <td style="padding: var(--spacing-sm); border-bottom: 1px solid var(--gray-200);">Session</td>
                            </tr>
                            <tr>
                                <td style="padding: var(--spacing-sm);">preferences</td>
                                <td style="padding: var(--spacing-sm);">User preferences</td>
                                <td style="padding: var(--spacing-sm);">1 year</td>
                            </tr>
                        </tbody>
                    </table>

                    <h2>Managing Cookies</h2>
                    <p>
                        You can control and manage cookies through your browser settings. Most browsers allow you to:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>View what cookies are stored and delete them individually</li>
                        <li>Block third-party cookies</li>
                        <li>Block all cookies from specific sites</li>
                        <li>Block all cookies from being set</li>
                        <li>Delete all cookies when you close your browser</li>
                    </ul>

                    <div style="background: var(--warning-light); padding: var(--spacing-lg); border-radius: var(--radius-lg); margin: var(--spacing-lg) 0;">
                        <strong style="color: #92400E;">Important:</strong>
                        <p style="color: #92400E; margin-bottom: 0;">
                            Disabling essential cookies may prevent you from using certain features of our platform, including logging in to your account.
                        </p>
                    </div>

                    <h2>Third-Party Cookies</h2>
                    <p>
                        We may use third-party services that set their own cookies, such as:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Payment processors (XpressPayments)</li>
                        <li>Analytics services</li>
                        <li>Security services</li>
                    </ul>
                    <p>
                        These third parties have their own privacy and cookie policies, which we encourage you to review.
                    </p>

                    <h2>Updates to This Policy</h2>
                    <p>
                        We may update this Cookie Policy from time to time. Any changes will be posted on this page with an updated revision date.
                    </p>

                    <h2>Contact Us</h2>
                    <p>
                        If you have questions about our use of cookies, please contact us at:
                    </p>
                    <p>
                        <strong>Email:</strong> <a href="mailto:hello@every27.com">hello@every27.com</a>
                    </p>

                </div>

            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
