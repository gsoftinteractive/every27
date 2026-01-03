<?php
/**
 * Every27 - FAQ Page
 * Frequently Asked Questions
 */

$page_title = 'FAQs';
$page_description = 'Find answers to frequently asked questions about Every27 payroll platform, pricing, salary advances, and more.';

include '../includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="/">Home</a>
            <span>/</span>
            <span class="current">FAQs</span>
        </div>
        <h1>Frequently Asked Questions</h1>
        <p>Got questions? We've got answers. Find everything you need to know about Every27.</p>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq section">
    <div class="container">
        <!-- General Questions -->
        <div class="faq-container mb-5">
            <h2 style="margin-bottom: var(--spacing-xl);">General Questions</h2>

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
                    Why is it called Every27?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Because we process and pay salaries every 27th of the month, without fail. The name is our promise - reliable, predictable payroll on the 27th.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Is Every27 available outside Nigeria?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Currently, we operate only in Nigeria. We plan to expand to other African countries soon. Stay tuned for updates!
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    What happens if the 27th falls on a weekend or holiday?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Payroll is processed on the 27th regardless of whether it falls on a weekend or public holiday. Our automated system runs 24/7.
                </div>
            </div>
        </div>

        <!-- Company Questions -->
        <div class="faq-container mb-5">
            <h2 style="margin-bottom: var(--spacing-xl);">For Companies</h2>

            <div class="faq-item">
                <button class="faq-question">
                    How do I sign up my company?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Visit our <a href="request-access.php">Request Access</a> page and submit your company details along with your CAC certificate or business registration document. Our team will review your application and get back to you within 1-3 business days.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    What documents do I need to provide?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    You'll need to provide one of the following: CAC Certificate, Business Registration Certificate, or Business License. This helps us verify your company is legitimate.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    How long does approval take?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Typically 1-3 business days after submitting all required documents. You'll receive an email notification once your application is approved.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    How do I fund my company wallet?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    You can fund your wallet via XpressPayments (instant) or bank transfer (manual verification within 24 hours). Simply log in to your dashboard, click "Fund Wallet," and follow the instructions.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    What if I don't have enough funds on the 27th?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    If your wallet balance is insufficient to cover both access fees and salaries, access fees will be deducted but salaries won't be processed. You'll need to fund your wallet and contact support for manual processing.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Can I add or remove employees at any time?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes, you can add employees at any time. To remove an employee, you can deactivate their account. Their records are preserved for audit purposes, but they won't receive salaries or be counted for access fees.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Can I change an employee's salary?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes, you can change employee salaries at any time. However, changes take effect from the next month's payroll. Mid-month changes won't affect the current month's payment.
                </div>
            </div>
        </div>

        <!-- Employee Questions -->
        <div class="faq-container mb-5">
            <h2 style="margin-bottom: var(--spacing-xl);">For Employees</h2>

            <div class="faq-item">
                <button class="faq-question">
                    How do I create an account?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    You don't create an account directly. Your employer adds you to the Every27 platform, and you receive login credentials via email. You can then log in and change your password.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    When do I get paid?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    On the 27th of every month, your salary is automatically credited to your Every27 wallet. You can then withdraw it to your personal bank account at any time.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    How do I withdraw my salary?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Log in to your dashboard, go to "Withdraw," enter the amount you want to withdraw, confirm your bank details, and click "Withdraw." Funds are sent to your bank account via XpressPayments, usually instantly.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Can I take a salary advance?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes, if you've been on the platform for at least 1 month and your company has enabled the feature. You can take up to 75% of your monthly salary as an advance, with a 7% transaction fee added to the repayment.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    How is the salary advance repaid?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Automatically. On the 27th, the advance amount plus the 7% transaction fee is deducted from your salary before the remaining balance is credited to your wallet.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Can I take multiple salary advances?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes, you can take multiple advances as long as the total doesn't exceed 75% of your monthly salary. For example, if your salary is ₦100,000, you can take ₦30,000 now and ₦45,000 later.
                </div>
            </div>
        </div>

        <!-- Pricing Questions -->
        <div class="faq-container mb-5">
            <h2 style="margin-bottom: var(--spacing-xl);">Pricing & Fees</h2>

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

            <div class="faq-item">
                <button class="faq-question">
                    Are there any hidden fees?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    No hidden fees whatsoever. You pay ₦1,500 per employee per month, and that's it. The 7% transaction fee only applies to salary advances taken by employees.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    When are access fees charged?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Access fees are automatically deducted from your company wallet on the 27th of each month, before salaries are processed. Make sure your wallet has enough to cover both.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Can the transaction fee rate be negotiated?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes, the 7% transaction fee is the default rate, but it can be adjusted based on your agreement with Every27. Contact our sales team to discuss custom rates for your organization.
                </div>
            </div>
        </div>

        <!-- Security Questions -->
        <div class="faq-container">
            <h2 style="margin-bottom: var(--spacing-xl);">Security & Support</h2>

            <div class="faq-item">
                <button class="faq-question">
                    Is my money safe?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Yes. We use bank-grade security measures to protect your funds and data. All transactions are encrypted, and we implement two-factor authentication for all accounts.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    What is 2FA and how does it work?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Two-Factor Authentication (2FA) adds an extra layer of security to your account. After entering your password, you'll receive a 6-digit code via email that you must enter to log in. Codes expire after 10 minutes.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    What if I forget my password?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Click "Forgot Password" on the login page and enter your email address. You'll receive a link to reset your password. For security, the link expires after a short time.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    How can I contact support?
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    Email us at support@every27.com or visit our <a href="contact.php">Contact page</a>. We respond to all inquiries within 24 hours on business days.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta section">
    <div class="container">
        <div class="cta-content reveal">
            <h2>Still Have Questions?</h2>
            <p>
                Our team is here to help. Reach out to us and we'll get back to you as soon as possible.
            </p>
            <div class="cta-actions">
                <a href="contact.php" class="btn btn-white btn-lg">
                    Contact Us
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="request-access.php" class="btn btn-outline btn-lg" style="border-color: white; color: white;">Request Access</a>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
