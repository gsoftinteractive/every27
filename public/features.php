<?php
/**
 * Every27 - Features Page
 * Detailed platform features
 */

$page_title = 'Features';
$page_description = 'Explore Every27\'s powerful features: automated payroll, salary advance, employee wallets, instant withdrawals, and more.';

include '../includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span class="current">Features</span>
        </div>
        <h1>Platform Features</h1>
        <p>Everything you need for effortless payroll management, all in one platform.</p>
    </div>
</section>

<!-- Main Features -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Core Features</span>
            <h2 class="section-title">Built for Modern Businesses</h2>
            <p class="section-description">
                Powerful features designed to simplify payroll for companies and employees alike.
            </p>
        </div>

        <!-- Feature 1: Automated Payroll -->
        <div class="benefits-grid mb-5 reveal">
            <div class="benefits-content">
                <div class="feature-icon mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h2>Automated Payroll Processing</h2>
                <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    On the 27th of every month, our system automatically processes your entire payroll. No manual intervention required, no spreadsheets to manage, no calculations to verify.
                </p>
                <ul class="benefits-list">
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Set It and Forget It</h4>
                            <p>Once configured, payroll runs automatically every month.</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Accurate Calculations</h4>
                            <p>Our system handles all calculations including bonuses, deductions, and advances.</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Instant Notifications</h4>
                            <p>Both employers and employees receive email notifications when payroll is processed.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div style="background: var(--secondary-color); border-radius: var(--radius-xl); padding: var(--spacing-2xl); display: flex; align-items: center; justify-content: center;">
                <div style="text-align: center;">
                    <div style="width: 120px; height: 120px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-lg);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div style="font-size: 2rem; font-weight: 800; color: var(--gray-900);">The 27th</div>
                    <div style="color: var(--gray-600);">Payday, Every Month</div>
                </div>
            </div>
        </div>

        <!-- Feature 2: Company Wallet -->
        <div class="benefits-grid mb-5 reveal" style="direction: rtl;">
            <div class="benefits-content" style="direction: ltr;">
                <div class="feature-icon mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                </div>
                <h2>Company Wallet</h2>
                <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    Your company wallet is where you hold funds for payroll. Fund it via XpressPayments or bank transfer, and we'll use it to pay your employees on the 27th.
                </p>
                <ul class="benefits-list">
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Multiple Funding Options</h4>
                            <p>Fund via XpressPayments (instant) or bank transfer (manual verification).</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Real-Time Balance</h4>
                            <p>Always know exactly how much is in your wallet and what you need for payroll.</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Secure Storage</h4>
                            <p>Your funds are held securely until payday with full audit trail.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div style="background: var(--secondary-color); border-radius: var(--radius-xl); padding: var(--spacing-2xl); display: flex; align-items: center; justify-content: center; direction: ltr;">
                <div style="background: white; border-radius: var(--radius-lg); padding: var(--spacing-xl); box-shadow: var(--shadow-lg); width: 100%; max-width: 300px;">
                    <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: var(--spacing-xs);">Company Wallet</div>
                    <div style="font-size: 2rem; font-weight: 800; color: var(--gray-900); margin-bottom: var(--spacing-lg);">₦2,500,000</div>
                    <div style="display: flex; gap: var(--spacing-sm);">
                        <div style="flex: 1; background: var(--primary-color); color: white; padding: var(--spacing-sm); border-radius: var(--radius-md); text-align: center; font-size: 0.875rem; font-weight: 500;">Fund Wallet</div>
                        <div style="flex: 1; background: var(--gray-100); color: var(--gray-700); padding: var(--spacing-sm); border-radius: var(--radius-md); text-align: center; font-size: 0.875rem; font-weight: 500;">History</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature 3: Employee Wallets -->
        <div class="benefits-grid mb-5 reveal">
            <div class="benefits-content">
                <div class="feature-icon mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h2>Employee Wallets</h2>
                <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    Each employee gets their own personal wallet where their salary is deposited. They can view their balance, transaction history, and withdraw funds anytime.
                </p>
                <ul class="benefits-list">
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Personal Dashboard</h4>
                            <p>Each employee has their own dashboard with salary info and transaction history.</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Instant Salary Credit</h4>
                            <p>Salaries are credited instantly on the 27th, no waiting for bank processing.</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Withdraw Anytime</h4>
                            <p>Employees can withdraw to their bank account whenever they want.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div style="background: var(--secondary-color); border-radius: var(--radius-xl); padding: var(--spacing-2xl); display: flex; align-items: center; justify-content: center;">
                <div style="background: white; border-radius: var(--radius-lg); padding: var(--spacing-xl); box-shadow: var(--shadow-lg); width: 100%; max-width: 300px;">
                    <div style="display: flex; align-items: center; gap: var(--spacing-md); margin-bottom: var(--spacing-lg);">
                        <div style="width: 48px; height: 48px; background: var(--secondary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; color: var(--primary-color);">JD</div>
                        <div>
                            <div style="font-weight: 600; color: var(--gray-900);">John Doe</div>
                            <div style="font-size: 0.875rem; color: var(--gray-500);">Software Developer</div>
                        </div>
                    </div>
                    <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: var(--spacing-xs);">Wallet Balance</div>
                    <div style="font-size: 1.75rem; font-weight: 800; color: var(--gray-900); margin-bottom: var(--spacing-md);">₦185,000</div>
                    <div style="background: var(--success-light); color: #065F46; padding: var(--spacing-sm); border-radius: var(--radius-md); text-align: center; font-size: 0.875rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline; vertical-align: middle; margin-right: 4px;">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Salary Paid - Dec 27
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature 4: Salary Advance -->
        <div class="benefits-grid reveal" style="direction: rtl;">
            <div class="benefits-content" style="direction: ltr;">
                <div class="feature-icon mb-3" style="background-color: var(--warning-light);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <h2>Salary Advance</h2>
                <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                    Life happens. Employees can access up to 75% of their salary before payday to handle emergencies. Repayment is automatic on the 27th.
                </p>
                <ul class="benefits-list">
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Up to 75% of Salary</h4>
                            <p>Employees can take multiple advances up to 75% of their monthly salary.</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>7% Transaction Fee</h4>
                            <p>Simple, transparent pricing. Fee is added to the repayment amount.</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Automatic Repayment</h4>
                            <p>Repayment is automatically deducted from salary on the 27th.</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="benefit-content">
                            <h4>Company Control</h4>
                            <p>Companies can enable/disable the feature and block specific employees.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div style="background: var(--secondary-color); border-radius: var(--radius-xl); padding: var(--spacing-2xl); display: flex; align-items: center; justify-content: center; direction: ltr;">
                <div style="background: white; border-radius: var(--radius-lg); padding: var(--spacing-xl); box-shadow: var(--shadow-lg); width: 100%; max-width: 300px;">
                    <div style="font-size: 1rem; font-weight: 600; color: var(--gray-900); margin-bottom: var(--spacing-md);">Request Advance</div>
                    <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: var(--spacing-xs);">Available (75% of salary)</div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--gray-900); margin-bottom: var(--spacing-lg);">₦150,000</div>
                    <div style="background: var(--gray-100); border-radius: var(--radius-md); padding: var(--spacing-md); margin-bottom: var(--spacing-md);">
                        <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: var(--spacing-xs);">Request Amount</div>
                        <div style="font-size: 1.25rem; font-weight: 600; color: var(--gray-900);">₦50,000</div>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: var(--spacing-md);">
                        <span style="color: var(--gray-500);">Transaction Fee (7%)</span>
                        <span style="color: var(--gray-900);">₦3,500</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem; padding-top: var(--spacing-md); border-top: 1px solid var(--gray-200);">
                        <span style="font-weight: 600; color: var(--gray-900);">Total Repayment</span>
                        <span style="font-weight: 600; color: var(--gray-900);">₦53,500</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- More Features Grid -->
<section class="section bg-gray-50">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">And More</span>
            <h2 class="section-title">Additional Features</h2>
            <p class="section-description">
                Every27 comes packed with features to make your payroll experience seamless.
            </p>
        </div>
        <div class="grid grid-3">
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Two-Factor Authentication</h3>
                <p class="feature-description">
                    Secure your account with email-based 2FA. Every login requires a verification code sent to your email.
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
                    Stay informed with instant email alerts for payments, withdrawals, advances, and important account activities.
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
                <h3 class="feature-title">Salary Adjustments</h3>
                <p class="feature-description">
                    Easily add bonuses, deductions, and allowances to any employee. All adjustments are visible in their dashboard.
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
                <h3 class="feature-title">Transaction History</h3>
                <p class="feature-description">
                    Complete audit trail of all wallet activities. Filter, search, and export transaction records anytime.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                        <line x1="12" y1="18" x2="12.01" y2="18"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Mobile Responsive</h3>
                <p class="feature-description">
                    Access your dashboard from any device. Our platform is fully responsive and optimized for mobile screens.
                </p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Easy Employee Management</h3>
                <p class="feature-description">
                    Add, edit, and manage employees with ease. Set salaries, update details, and control access from one dashboard.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta section">
    <div class="container">
        <div class="cta-content reveal">
            <h2>Ready to Experience These Features?</h2>
            <p>
                Join hundreds of companies already using Every27 for seamless payroll management.
            </p>
            <div class="cta-actions">
                <a href="request-access.php" class="btn btn-white btn-lg">
                    Request Access
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="pricing.php" class="btn btn-outline btn-lg" style="border-color: white; color: white;">View Pricing</a>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
