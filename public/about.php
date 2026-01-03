<?php
/**
 * Every27 - About Page
 * Company information and mission
 */

$page_title = 'About Us';
$page_description = 'Learn about Every27\'s mission to solve late and erratic salary payments in Africa. We\'re building the future of payroll management.';

include '../includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span class="current">About Us</span>
        </div>
        <h1>About Every27</h1>
        <p>We're on a mission to ensure every worker in Africa gets paid on time, every time.</p>
    </div>
</section>

<!-- Mission Section -->
<section class="section">
    <div class="container">
        <div class="benefits-grid">
            <div class="benefits-content reveal">
                <span class="section-subtitle">Our Mission</span>
                <h2>Transforming Payroll Across Africa</h2>
                <p class="text-lg" style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    Every27 was born from a simple observation: millions of workers across Africa face the frustrating reality of unpredictable salary payments. Late salaries cause financial stress, reduced productivity, and broken trust between employers and employees.
                </p>
                <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    We believe that every worker deserves to know exactly when they'll be paid. That's why we built Every27 - an automated payroll platform that processes salaries on the 27th of every month, without fail.
                </p>
                <p style="color: var(--gray-600);">
                    Our platform removes the complexity and uncertainty from payroll. Companies fund their wallets, add their employees, and we handle the rest. It's that simple.
                </p>
            </div>
            <div class="benefits-image reveal">
                <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); border-radius: var(--radius-xl); padding: var(--spacing-3xl); color: white; text-align: center;">
                    <div style="font-size: 4rem; font-weight: 800; margin-bottom: var(--spacing-md);">27</div>
                    <div style="font-size: 1.25rem; font-weight: 600; margin-bottom: var(--spacing-sm);">Payday, Every Month</div>
                    <div style="opacity: 0.8;">No exceptions. No excuses.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section bg-gray-50">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Our Values</span>
            <h2 class="section-title">What We Stand For</h2>
            <p class="section-description">
                These core values guide everything we do at Every27.
            </p>
        </div>
        <div class="grid grid-3">
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3 class="feature-title">Reliability</h3>
                <p class="feature-description">
                    We deliver on our promises. When we say payday is the 27th, we mean it. Our automated systems ensure consistent, dependable payroll processing.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </div>
                <h3 class="feature-title">Transparency</h3>
                <p class="feature-description">
                    No hidden fees, no surprises. We believe in clear communication and honest pricing. Both employers and employees can see exactly what's happening with their money.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Security</h3>
                <p class="feature-description">
                    Your data and funds are protected with enterprise-grade security. We use encryption, two-factor authentication, and regular security audits.
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
                <h3 class="feature-title">Employee-Centric</h3>
                <p class="feature-description">
                    We put employees first. Our platform is designed to give workers financial stability and peace of mind through timely, predictable payments.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
                <h3 class="feature-title">Simplicity</h3>
                <p class="feature-description">
                    Complex problems deserve simple solutions. We've stripped away the complexity of payroll management to create an intuitive, easy-to-use platform.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                        <line x1="9" y1="9" x2="9.01" y2="9"></line>
                        <line x1="15" y1="9" x2="15.01" y2="9"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Customer Success</h3>
                <p class="feature-description">
                    Your success is our success. We provide dedicated support and resources to ensure you get the most out of Every27.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="section">
    <div class="container">
        <div class="benefits-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="benefits-image reveal">
                <div style="background: var(--secondary-color); border-radius: var(--radius-xl); padding: var(--spacing-3xl); text-align: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="var(--primary-color)" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto var(--spacing-lg);">
                        <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                        <line x1="16" y1="8" x2="2" y2="22"></line>
                        <line x1="17.5" y1="15" x2="9" y2="15"></line>
                    </svg>
                    <div style="font-size: 1.25rem; font-weight: 600; color: var(--gray-900);">Built in Nigeria</div>
                    <div style="color: var(--gray-600);">For African Businesses</div>
                </div>
            </div>
            <div class="benefits-content reveal">
                <span class="section-subtitle">Our Story</span>
                <h2>Why We Built Every27</h2>
                <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    We've seen firsthand the impact of late salary payments. Employees struggling to pay rent, defaulting on loans, unable to meet basic needs - all because their employers couldn't pay them on time.
                </p>
                <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    The problem isn't always malicious. Many businesses struggle with cash flow, manual processes, and the complexity of payroll management. But the result is the same: workers suffer.
                </p>
                <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    Every27 exists to bridge this gap. We provide the infrastructure for reliable payroll processing, so companies can focus on their business while employees enjoy financial stability.
                </p>
                <p style="color: var(--gray-600);">
                    Our name says it all: Every 27th of the month, your employees get paid. That's our promise, and that's what we deliver.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section bg-primary" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
    <div class="container">
        <div class="grid grid-4" style="text-align: center; color: white;">
            <div class="reveal">
                <div style="font-size: 3rem; font-weight: 800; margin-bottom: var(--spacing-sm);" data-counter="100">0</div>
                <div style="opacity: 0.8;">Companies Trust Us</div>
            </div>
            <div class="reveal">
                <div style="font-size: 3rem; font-weight: 800; margin-bottom: var(--spacing-sm);" data-counter="1000">0</div>
                <div style="opacity: 0.8;">Employees Paid</div>
            </div>
            <div class="reveal">
                <div style="font-size: 3rem; font-weight: 800; margin-bottom: var(--spacing-sm);">99.9%</div>
                <div style="opacity: 0.8;">Uptime</div>
            </div>
            <div class="reveal">
                <div style="font-size: 3rem; font-weight: 800; margin-bottom: var(--spacing-sm);">24/7</div>
                <div style="opacity: 0.8;">Platform Access</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta section">
    <div class="container">
        <div class="cta-content reveal">
            <h2>Ready to Join Us?</h2>
            <p>
                Become part of the Every27 family. Let us handle your payroll so you can focus on what matters most - growing your business.
            </p>
            <p style="opacity: 0.9; margin-bottom: var(--spacing-lg);">
                Contact us at <a href="mailto:hello@every27.com" style="color: white; text-decoration: underline;">hello@every27.com</a>
            </p>
            <div class="cta-actions">
                <a href="request-access.php" class="btn btn-white btn-lg">
                    Request Access
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="contact.php" class="btn btn-outline btn-lg" style="border-color: white; color: white;">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
