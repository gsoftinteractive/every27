<?php
/**
 * Every27 - Help Center Page
 */

$page_title = 'Help Center';
$page_description = 'Get help with Every27. Find answers to common questions, guides, and contact support.';

include '../includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="/">Home</a>
            <span>/</span>
            <span class="current">Help Center</span>
        </div>
        <h1>Help Center</h1>
        <p>Find answers, guides, and get support for Every27.</p>
    </div>
</section>

<!-- Quick Links -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Quick Help</span>
            <h2 class="section-title">What Do You Need Help With?</h2>
        </div>

        <div class="grid grid-3 mb-5">
            <a href="faq" class="feature-card reveal" style="text-decoration: none;">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <h3 class="feature-title">FAQs</h3>
                <p class="feature-description">
                    Find answers to frequently asked questions about Every27.
                </p>
            </a>
            <a href="#getting-started" class="feature-card reveal" style="text-decoration: none;">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Getting Started</h3>
                <p class="feature-description">
                    New to Every27? Learn how to set up and use the platform.
                </p>
            </a>
            <a href="contact" class="feature-card reveal" style="text-decoration: none;">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Contact Support</h3>
                <p class="feature-description">
                    Can't find what you need? Our team is here to help.
                </p>
            </a>
        </div>

        <!-- Getting Started Section -->
        <div id="getting-started" class="mb-5">
            <h2 style="margin-bottom: var(--spacing-xl);">Getting Started Guides</h2>

            <div class="grid grid-2">
                <div class="card reveal">
                    <div class="card-body">
                        <h3 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">For Companies</h3>
                        <ol style="color: var(--gray-600); padding-left: var(--spacing-lg);">
                            <li style="margin-bottom: var(--spacing-sm);">Request access at <a href="request-access">Request Access</a></li>
                            <li style="margin-bottom: var(--spacing-sm);">Submit your CAC certificate or business documents</li>
                            <li style="margin-bottom: var(--spacing-sm);">Wait for approval (1-3 business days)</li>
                            <li style="margin-bottom: var(--spacing-sm);">Log in and complete your company profile</li>
                            <li style="margin-bottom: var(--spacing-sm);">Add your employees</li>
                            <li style="margin-bottom: var(--spacing-sm);">Fund your wallet before the 27th</li>
                            <li>We automatically pay your employees!</li>
                        </ol>
                    </div>
                </div>
                <div class="card reveal">
                    <div class="card-body">
                        <h3 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">For Employees</h3>
                        <ol style="color: var(--gray-600); padding-left: var(--spacing-lg);">
                            <li style="margin-bottom: var(--spacing-sm);">Your company adds you to Every27</li>
                            <li style="margin-bottom: var(--spacing-sm);">Check your email for login credentials</li>
                            <li style="margin-bottom: var(--spacing-sm);">Log in and change your password</li>
                            <li style="margin-bottom: var(--spacing-sm);">Add your bank account details</li>
                            <li style="margin-bottom: var(--spacing-sm);">Get paid on the 27th every month</li>
                            <li style="margin-bottom: var(--spacing-sm);">Withdraw funds to your bank anytime</li>
                            <li>Request salary advance if needed</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documentation Section -->
        <div class="mb-5">
            <h2 style="margin-bottom: var(--spacing-xl);">Documentation</h2>
            <div class="card reveal">
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: var(--spacing-xl); flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px;">
                            <h3 style="color: var(--primary-color); margin-bottom: var(--spacing-sm);">Every27 Platform Handbook</h3>
                            <p style="color: var(--gray-600); margin-bottom: 0;">
                                Complete guide to using Every27 - for companies and employees. Learn about features, pricing, salary advance, and more.
                            </p>
                        </div>
                        <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
                            <a href="docs/Every27_Handbook.html" target="_blank" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                View Online
                            </a>
                            <a href="docs/Every27_Handbook.md" download class="btn btn-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download (Text)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Options -->
        <div class="card reveal" style="background: var(--secondary-color); border: none;">
            <div class="card-body" style="padding: var(--spacing-2xl);">
                <h2 style="margin-bottom: var(--spacing-xl); text-align: center;">Contact Our Support Team</h2>
                <div class="grid grid-3">
                    <div style="text-align: center;">
                        <div style="width: 60px; height: 60px; background: var(--primary-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-md);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <h4>General Inquiries</h4>
                        <a href="mailto:hello@every27.com" style="color: var(--primary-color);">hello@every27.com</a>
                    </div>
                    <div style="text-align: center;">
                        <div style="width: 60px; height: 60px; background: var(--primary-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-md);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                        </div>
                        <h4>Customer Support</h4>
                        <a href="mailto:support@every27.com" style="color: var(--primary-color);">support@every27.com</a>
                    </div>
                    <div style="text-align: center;">
                        <div style="width: 60px; height: 60px; background: var(--primary-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-md);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                        </div>
                        <h4>Technical Support</h4>
                        <a href="mailto:tech@every27.com" style="color: var(--primary-color);">tech@every27.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
