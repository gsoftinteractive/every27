<?php
/**
 * Every27 - Terms of Service Page
 */

$page_title = 'Terms of Service';
$page_description = 'Read Every27\'s Terms of Service. Understand the rules and regulations governing use of our payroll platform.';

include '../includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="/">Home</a>
            <span>/</span>
            <span class="current">Terms of Service</span>
        </div>
        <h1>Terms of Service</h1>
        <p>Last updated: January 2026</p>
    </div>
</section>

<!-- Terms Content -->
<section class="section">
    <div class="container">
        <div class="card" style="max-width: 900px; margin: 0 auto;">
            <div class="card-body" style="padding: var(--spacing-2xl);">

                <div style="color: var(--gray-600); line-height: 1.8;">

                    <h2>1. Introduction</h2>
                    <p>
                        Welcome to Every27. These Terms of Service ("Terms") govern your use of the Every27 platform and services operated by Every27 Limited ("Every27", "we", "us", or "our").
                    </p>
                    <p>
                        By accessing or using our platform, you agree to be bound by these Terms. If you disagree with any part of the terms, you may not access the platform.
                    </p>

                    <h2>2. Definitions</h2>
                    <p>
                        <strong>"Platform"</strong> refers to the Every27 web application and associated services.<br>
                        <strong>"Company"</strong> refers to any business entity registered on our platform.<br>
                        <strong>"Employee"</strong> refers to individuals registered by a Company to receive salary payments.<br>
                        <strong>"Wallet"</strong> refers to the digital account maintained within the platform.<br>
                        <strong>"Payday"</strong> refers to the 27th of each calendar month when salaries are processed.<br>
                        <strong>"Salary Advance"</strong> refers to the facility allowing Employees to access salary before Payday.
                    </p>

                    <h2>3. Eligibility</h2>
                    <p>
                        To use our services, Companies must:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Be a legally registered business entity in Nigeria</li>
                        <li>Provide valid registration documents (CAC Certificate or equivalent)</li>
                        <li>Have authorized representatives with authority to bind the Company</li>
                        <li>Maintain accurate and up-to-date information on the platform</li>
                    </ul>
                    <p>
                        Employee accounts are created by Companies and do not require separate registration.
                    </p>

                    <h2>4. Services</h2>
                    <h3>4.1 For Companies</h3>
                    <p>We provide:</p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Automated payroll processing on the 27th of each month</li>
                        <li>Company wallet for holding funds</li>
                        <li>Employee management tools</li>
                        <li>Transaction history and reporting</li>
                        <li>Salary adjustment features (bonuses, deductions, allowances)</li>
                    </ul>

                    <h3>4.2 For Employees</h3>
                    <p>We provide:</p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Personal wallet for receiving salary</li>
                        <li>Withdrawal to personal bank accounts</li>
                        <li>Salary advance facility (subject to eligibility)</li>
                        <li>Transaction history</li>
                    </ul>

                    <h2>5. Fees and Payments</h2>
                    <h3>5.1 Access Fee</h3>
                    <p>
                        Companies pay an access fee of ₦1,500 per employee per month. This fee is automatically deducted from the Company Wallet on Payday (the 27th) before salaries are processed.
                    </p>

                    <h3>5.2 Transaction Fee</h3>
                    <p>
                        A transaction fee of 7% (or as otherwise agreed) applies to Salary Advances taken by Employees. This fee is added to the repayment amount and deducted from the Employee's salary on Payday.
                    </p>

                    <h3>5.3 Insufficient Funds</h3>
                    <p>
                        If the Company Wallet has insufficient funds to cover both access fees and salaries:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Access fees will be deducted</li>
                        <li>Salaries will NOT be processed</li>
                        <li>The Company is responsible for any resulting delays</li>
                    </ul>

                    <h2>6. Salary Advance</h2>
                    <p>
                        <strong>Eligibility:</strong> Employees must be registered on the platform for at least 1 month and the feature must be enabled by their Company.<br>
                        <strong>Limit:</strong> Up to 75% of monthly salary.<br>
                        <strong>Fee:</strong> 7% transaction fee (or as agreed with the Company).<br>
                        <strong>Repayment:</strong> Automatic deduction from salary on Payday.
                    </p>
                    <p>
                        Companies may disable this feature or block specific Employees at their discretion.
                    </p>

                    <h2>7. User Responsibilities</h2>
                    <h3>7.1 Companies</h3>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Maintain accurate employee information</li>
                        <li>Ensure sufficient wallet balance before Payday</li>
                        <li>Comply with applicable labor laws</li>
                        <li>Protect login credentials</li>
                        <li>Handle recovery of advances from terminated employees</li>
                    </ul>

                    <h3>7.2 Employees</h3>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Maintain accurate bank account information</li>
                        <li>Protect login credentials</li>
                        <li>Repay salary advances as agreed</li>
                    </ul>

                    <h2>8. Security</h2>
                    <p>
                        We implement industry-standard security measures including:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Data encryption in transit and at rest</li>
                        <li>Two-factor authentication (2FA)</li>
                        <li>Regular security audits</li>
                        <li>Secure payment processing</li>
                    </ul>
                    <p>
                        Users are responsible for maintaining the security of their accounts and must report any unauthorized access immediately.
                    </p>

                    <h2>9. Limitation of Liability</h2>
                    <p>
                        Every27 shall not be liable for:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>Delays caused by insufficient Company wallet funds</li>
                        <li>Errors from incorrect information provided by users</li>
                        <li>Banking system failures beyond our control</li>
                        <li>Force majeure events</li>
                        <li>Unrecovered salary advances from terminated employees</li>
                        <li>Indirect, incidental, or consequential damages</li>
                    </ul>
                    <p>
                        Our maximum liability is limited to the total access fees paid in the three months preceding any claim.
                    </p>

                    <h2>10. Termination</h2>
                    <p>
                        Either party may terminate use of the platform with 30 days written notice. We may terminate immediately if:
                    </p>
                    <ul style="margin-left: var(--spacing-xl); margin-bottom: var(--spacing-lg);">
                        <li>You breach these Terms</li>
                        <li>You fail to fund your wallet for three consecutive months</li>
                        <li>You engage in fraudulent or illegal activities</li>
                    </ul>
                    <p>
                        Upon termination, outstanding salary advances must be repaid and remaining wallet balances (after deductions) will be refunded within 14 days.
                    </p>

                    <h2>11. Privacy</h2>
                    <p>
                        Your use of the platform is also governed by our <a href="privacy">Privacy Policy</a>. By using our services, you consent to the collection and use of information as described therein.
                    </p>

                    <h2>12. Changes to Terms</h2>
                    <p>
                        We reserve the right to modify these Terms at any time. We will provide notice of significant changes via email or platform notification. Continued use of the platform after changes constitutes acceptance of the new Terms.
                    </p>

                    <h2>13. Governing Law</h2>
                    <p>
                        These Terms are governed by the laws of the Federal Republic of Nigeria. Any disputes shall be resolved through mediation or arbitration in Lagos, Nigeria.
                    </p>

                    <h2>14. Contact Information</h2>
                    <p>
                        For questions about these Terms, please contact us at:<br>
                        <strong>Email:</strong> legal@every27.com<br>
                        <strong>Address:</strong> Lagos, Nigeria
                    </p>

                </div>

            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
