<?php
/**
 * Every27 - Request Access Page
 * Company invitation request form
 */

$page_title = 'Request Access';
$page_description = 'Request access to Every27 payroll platform. Submit your company details and documentation to get started.';

include '../includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span class="current">Request Access</span>
        </div>
        <h1>Request Access</h1>
        <p>Join Every27 and transform how you handle payroll. Submit your details below.</p>
    </div>
</section>

<!-- Request Form Section -->
<section class="section">
    <div class="container">
        <div class="grid grid-2" style="gap: var(--spacing-3xl); align-items: start;">
            <!-- Form -->
            <div class="card reveal">
                <div class="card-body">
                    <h2 style="margin-bottom: var(--spacing-md);">Company Information</h2>
                    <p style="color: var(--gray-500); margin-bottom: var(--spacing-xl);">
                        Fill out the form below and our team will review your application within 1-3 business days.
                    </p>

                    <form action="#" method="POST" data-validate>
                        <div class="form-group">
                            <label for="company_name" class="form-label">Company Name *</label>
                            <input type="text" id="company_name" name="company_name" class="form-input" placeholder="Enter your company name" required>
                        </div>

                        <div class="form-group">
                            <label for="rc_number" class="form-label">RC/CAC Number *</label>
                            <input type="text" id="rc_number" name="rc_number" class="form-input" placeholder="e.g., RC123456" required>
                        </div>

                        <div class="grid grid-2">
                            <div class="form-group">
                                <label for="contact_name" class="form-label">Contact Person Name *</label>
                                <input type="text" id="contact_name" name="contact_name" class="form-input" placeholder="Full name" required>
                            </div>
                            <div class="form-group">
                                <label for="position" class="form-label">Position/Title *</label>
                                <input type="text" id="position" name="position" class="form-input" placeholder="e.g., HR Manager" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Business Email *</label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="you@company.com" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" class="form-input" placeholder="e.g., 08012345678" required>
                        </div>

                        <div class="form-group">
                            <label for="employee_count" class="form-label">Number of Employees *</label>
                            <select id="employee_count" name="employee_count" class="form-select" required>
                                <option value="">Select range</option>
                                <option value="1-10">1-10 employees</option>
                                <option value="11-50">11-50 employees</option>
                                <option value="51-100">51-100 employees</option>
                                <option value="101-500">101-500 employees</option>
                                <option value="500+">500+ employees</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="industry" class="form-label">Industry</label>
                            <select id="industry" name="industry" class="form-select">
                                <option value="">Select industry</option>
                                <option value="technology">Technology</option>
                                <option value="finance">Finance & Banking</option>
                                <option value="healthcare">Healthcare</option>
                                <option value="education">Education</option>
                                <option value="retail">Retail & E-commerce</option>
                                <option value="manufacturing">Manufacturing</option>
                                <option value="construction">Construction</option>
                                <option value="hospitality">Hospitality</option>
                                <option value="logistics">Logistics & Transportation</option>
                                <option value="agriculture">Agriculture</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Company Address *</label>
                            <textarea id="address" name="address" class="form-textarea" placeholder="Enter your company address" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Additional Information</label>
                            <textarea id="message" name="message" class="form-textarea" placeholder="Tell us more about your company and payroll needs (optional)" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label style="display: flex; align-items: flex-start; gap: var(--spacing-sm); cursor: pointer;">
                                <input type="checkbox" name="agree_terms" required style="margin-top: 4px;">
                                <span style="font-size: 0.875rem; color: var(--gray-600);">
                                    I agree to the <a href="terms.php" target="_blank">Terms of Service</a> and <a href="privacy.php" target="_blank">Privacy Policy</a>. I understand that my application will be reviewed and I will be contacted via email.
                                </span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Submit Request
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Sidebar -->
            <div>
                <div class="card mb-4 reveal">
                    <div class="card-body">
                        <h3 style="margin-bottom: var(--spacing-lg);">What Happens Next?</h3>
                        <div style="display: flex; flex-direction: column; gap: var(--spacing-lg);">
                            <div style="display: flex; gap: var(--spacing-md);">
                                <div style="width: 32px; height: 32px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0;">1</div>
                                <div>
                                    <h4 style="margin-bottom: var(--spacing-xs);">Submit Your Request</h4>
                                    <p style="color: var(--gray-500); margin-bottom: 0; font-size: 0.9375rem;">Fill out the form with your company details.</p>
                                </div>
                            </div>
                            <div style="display: flex; gap: var(--spacing-md);">
                                <div style="width: 32px; height: 32px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0;">2</div>
                                <div>
                                    <h4 style="margin-bottom: var(--spacing-xs);">We Review</h4>
                                    <p style="color: var(--gray-500); margin-bottom: 0; font-size: 0.9375rem;">Our team reviews your application within 1-3 business days.</p>
                                </div>
                            </div>
                            <div style="display: flex; gap: var(--spacing-md);">
                                <div style="width: 32px; height: 32px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0;">3</div>
                                <div>
                                    <h4 style="margin-bottom: var(--spacing-xs);">Get Approved</h4>
                                    <p style="color: var(--gray-500); margin-bottom: 0; font-size: 0.9375rem;">Once approved, you'll receive an email with login credentials.</p>
                                </div>
                            </div>
                            <div style="display: flex; gap: var(--spacing-md);">
                                <div style="width: 32px; height: 32px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0;">4</div>
                                <div>
                                    <h4 style="margin-bottom: var(--spacing-xs);">Start Using Every27</h4>
                                    <p style="color: var(--gray-500); margin-bottom: 0; font-size: 0.9375rem;">Complete your profile, add employees, and fund your wallet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 reveal">
                    <div class="card-body">
                        <h3 style="margin-bottom: var(--spacing-lg);">Required Documents</h3>
                        <p style="color: var(--gray-500); margin-bottom: var(--spacing-md); font-size: 0.9375rem;">
                            After initial approval, you'll need to upload one of the following:
                        </p>
                        <ul style="color: var(--gray-600); font-size: 0.9375rem;">
                            <li style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-sm);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                CAC Certificate
                            </li>
                            <li style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-sm);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Business Registration Certificate
                            </li>
                            <li style="display: flex; align-items: center; gap: var(--spacing-sm);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Business License
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card reveal" style="background: var(--secondary-color); border: none;">
                    <div class="card-body">
                        <h3 style="margin-bottom: var(--spacing-md);">Need Help?</h3>
                        <p style="color: var(--gray-600); margin-bottom: var(--spacing-md); font-size: 0.9375rem;">
                            Have questions about Every27 or the application process? We're here to help.
                        </p>
                        <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg); font-size: 0.9375rem;">
                            Email us at <a href="mailto:business@every27.com">business@every27.com</a>
                        </p>
                        <a href="contact.php" class="btn btn-primary">
                            Contact Us
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
