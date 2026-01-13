<?php
/**
 * Every27 - Home Page
 * Main landing page for the platform
 */

$page_title = 'Home';
$page_description = 'Every27 is a modern payroll platform ensuring employees receive their salaries on the 27th of every month. Solving late and erratic salary payments in Africa.';

include '../includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    Trusted by 100+ Companies
                </div>
                <h1 class="hero-title">
                    Your Salary,<br>
                    <span class="highlight">On Time, Every Time</span>
                </h1>
                <p class="hero-description">
                    Every27 ensures your employees receive their salaries on the 27th of every month. No more late payments, no more excuses. Just reliable, automated payroll that works.
                </p>
                <div class="hero-actions">
                    <a href="request-access" class="btn btn-primary btn-lg">
                        Get Started Free
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="features" class="btn btn-outline btn-lg">Learn More</a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number" data-counter="1000">0</span>
                        <span class="stat-label">Employees Paid</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-counter="100">0</span>
                        <span class="stat-label">Companies Trust Us</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">99.9%</span>
                        <span class="stat-label">Uptime</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img src="assets/images/hero-dashboard.png" alt="Every27 Dashboard Preview" onerror="this.style.display='none'">
                <!-- Floating Cards -->
                <div class="floating-card card-1" style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 40px; height: 40px; background: #10B981; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 14px; color: #111827;">Salary Paid</div>
                        <div style="font-size: 12px; color: #6B7280;">Just now</div>
                    </div>
                </div>
                <div class="floating-card card-2" style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 40px; height: 40px; background: #0E84F1; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 14px; color: #111827;">Wallet Funded</div>
                        <div style="font-size: 12px; color: #6B7280;">+₦2,500,000</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Problem Section -->
<section class="section bg-white">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">The Problem</span>
            <h2 class="section-title">Late Salaries Are Crippling Africa's Workforce</h2>
            <p class="section-description">
                Millions of workers across Africa face the same frustrating reality: unpredictable salary payments that disrupt their lives and livelihoods.
            </p>
        </div>
        <div class="grid grid-3">
            <div class="feature-card reveal">
                <div class="feature-icon" style="background-color: #FEE2E2;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Financial Stress</h3>
                <p class="feature-description">
                    Employees can't plan their finances when they don't know when they'll be paid. Bills pile up, debts accumulate.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon" style="background-color: #FEF3C7;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Lost Productivity</h3>
                <p class="feature-description">
                    Workers distracted by financial worries are less productive. Companies lose output while employees lose motivation.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon" style="background-color: #DBEAFE;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Broken Trust</h3>
                <p class="feature-description">
                    Late payments damage the employer-employee relationship. High turnover costs companies even more money.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Solution Section -->
<section class="section bg-gray-50">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Our Solution</span>
            <h2 class="section-title">Automated Payroll That Just Works</h2>
            <p class="section-description">
                Every27 takes the complexity out of payroll. Fund your wallet, add your employees, and we handle the rest.
            </p>
        </div>
        <div class="grid grid-2" style="max-width: 900px; margin: 0 auto;">
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Company Wallet</h3>
                <p class="feature-description">
                    Fund your company wallet via bank transfer or XpressPayments. Your funds are held securely until payday.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3 class="feature-title">Automatic Processing</h3>
                <p class="feature-description">
                    On the 27th of every month, we automatically process your payroll. No manual intervention needed.
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
                <h3 class="feature-title">Employee Wallets</h3>
                <p class="feature-description">
                    Each employee gets a personal wallet. Salaries are credited instantly on payday.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Instant Withdrawals</h3>
                <p class="feature-description">
                    Employees can withdraw their funds to any Nigerian bank account instantly via XpressPayments.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">How It Works</span>
            <h2 class="section-title">Get Started in 4 Simple Steps</h2>
            <p class="section-description">
                From signup to payday, we've made every step simple and straightforward.
            </p>
        </div>
        <div class="steps-container">
            <div class="step-card reveal">
                <div class="step-number">1</div>
                <h3 class="step-title">Request Access</h3>
                <p class="step-description">
                    Submit your company details and documentation. Our team will review your application.
                </p>
            </div>
            <div class="step-card reveal">
                <div class="step-number">2</div>
                <h3 class="step-title">Add Employees</h3>
                <p class="step-description">
                    Once approved, add your employees to the platform. They'll receive login credentials instantly.
                </p>
            </div>
            <div class="step-card reveal">
                <div class="step-number">3</div>
                <h3 class="step-title">Fund Wallet</h3>
                <p class="step-description">
                    Add funds to your company wallet before the 27th. Use XpressPayments or bank transfer.
                </p>
            </div>
            <div class="step-card reveal">
                <div class="step-number">4</div>
                <h3 class="step-title">We Pay Them</h3>
                <p class="step-description">
                    On the 27th, we automatically process payroll. Your employees get paid on time, every time.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Features</span>
            <h2 class="section-title">Everything You Need for Effortless Payroll</h2>
            <p class="section-description">
                Powerful features designed to make payroll management simple for companies and employees alike.
            </p>
        </div>
        <div class="grid grid-3">
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Bank-Grade Security</h3>
                <p class="feature-description">
                    Your data and funds are protected with enterprise-level encryption and two-factor authentication.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Salary Advance</h3>
                <p class="feature-description">
                    Employees can access up to 75% of their salary before payday. Repayment is automatic on the 27th.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <h3 class="feature-title">Detailed Reports</h3>
                <p class="feature-description">
                    Complete transaction history, payroll summaries, and downloadable reports for your records.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <h3 class="feature-title">Email Notifications</h3>
                <p class="feature-description">
                    Stay informed with instant email alerts for payments, withdrawals, and important updates.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Easy Adjustments</h3>
                <p class="feature-description">
                    Add bonuses, deductions, and allowances with ease. All adjustments are visible to employees.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                        <line x1="12" y1="18" x2="12.01" y2="18"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Mobile Friendly</h3>
                <p class="feature-description">
                    Access your dashboard from any device. Our platform is fully responsive and works beautifully on mobile.
                </p>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="features" class="btn btn-primary btn-lg">Explore All Features</a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Testimonials</span>
            <h2 class="section-title">What Our Clients Say</h2>
            <p class="section-description">
                Join hundreds of companies that trust Every27 for their payroll needs.
            </p>
        </div>
        <div class="grid grid-3">
            <div class="testimonial-card reveal">
                <p class="testimonial-content">
                    "Every27 has transformed how we handle payroll. Our employees now get paid on time, every single month. The stress of manual payroll processing is gone."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">AO</div>
                    <div class="testimonial-info">
                        <h4>Adebayo Ogunlesi</h4>
                        <p>CEO, TechNova Solutions</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal">
                <p class="testimonial-content">
                    "The salary advance feature is a game-changer for our staff. They can handle emergencies without coming to HR for advances. It's automated and transparent."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">CF</div>
                    <div class="testimonial-info">
                        <h4>Chioma Fashola</h4>
                        <p>HR Director, Greenfield Ltd</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal">
                <p class="testimonial-content">
                    "As an employee, I love knowing exactly when I'll be paid. The 27th is payday, no questions asked. I can finally plan my finances properly."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">EN</div>
                    <div class="testimonial-info">
                        <h4>Emmanuel Nwachukwu</h4>
                        <p>Software Developer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta section">
    <div class="container">
        <div class="cta-content reveal">
            <h2>Ready to Transform Your Payroll?</h2>
            <p>
                Join hundreds of companies that trust Every27 for reliable, automated salary payments. Your employees deserve to be paid on time.
            </p>
            <div class="cta-actions">
                <a href="request-access" class="btn btn-white btn-lg">
                    Request Access
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="contact" class="btn btn-outline btn-lg" style="border-color: white; color: white;">Contact Sales</a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Preview -->
<section class="faq section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">FAQs</span>
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-description">
                Got questions? We've got answers. Here are some of the most common things people ask us.
            </p>
        </div>
        <div class="faq-container">
            <div class="faq-item">
                <button class="faq-question">
                    What is Every27?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Every27 is a modern payroll management platform that ensures employees receive their salaries on the 27th of every month. We solve the problem of late and erratic salary payments by providing automated, reliable payroll processing for African businesses.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    How do I sign up my company?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Visit our Request Access page and submit your company details along with your CAC certificate or business registration document. Our team will review your application and get back to you within 1-3 business days.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    What is the salary advance feature?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Salary advance allows employees to access up to 75% of their monthly salary before payday. A 7% transaction fee is added to the repayment amount, which is automatically deducted from their salary on the 27th.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    How much does Every27 cost?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    We charge a simple access fee of ₦1,500 per employee per month. This covers unlimited payroll processing, employee wallets, email notifications, and customer support. There are no hidden fees.
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="faq" class="btn btn-outline">View All FAQs</a>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
