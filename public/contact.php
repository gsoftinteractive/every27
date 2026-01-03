<?php
/**
 * Every27 - Contact Page
 * Contact information and form
 */

$page_title = 'Contact Us';
$page_description = 'Get in touch with Every27. Contact our team for support, sales inquiries, or general questions.';

include '../includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span class="current">Contact</span>
        </div>
        <h1>Contact Us</h1>
        <p>We'd love to hear from you. Get in touch with our team.</p>
    </div>
</section>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div class="grid grid-2" style="gap: var(--spacing-3xl); align-items: start;">
            <!-- Contact Form -->
            <div class="card reveal">
                <div class="card-body">
                    <h2 style="margin-bottom: var(--spacing-md);">Send Us a Message</h2>
                    <p style="color: var(--gray-500); margin-bottom: var(--spacing-xl);">
                        Fill out the form below and we'll get back to you within 24 hours.
                    </p>

                    <form action="#" method="POST" data-validate>
                        <div class="grid grid-2">
                            <div class="form-group">
                                <label for="first_name" class="form-label">First Name *</label>
                                <input type="text" id="first_name" name="first_name" class="form-input" placeholder="John" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="form-label">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" class="form-input" placeholder="Doe" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="you@example.com" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-input" placeholder="e.g., 08012345678">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Subject *</label>
                            <select id="subject" name="subject" class="form-select" required>
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="sales">Sales / Pricing</option>
                                <option value="support">Technical Support</option>
                                <option value="partnership">Partnership</option>
                                <option value="feedback">Feedback</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Message *</label>
                            <textarea id="message" name="message" class="form-textarea" placeholder="How can we help you?" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Send Message
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div>
                <div class="reveal">
                    <h2 style="margin-bottom: var(--spacing-xl);">Get in Touch</h2>

                    <div class="contact-info-card mb-4">
                        <div class="contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h4>Email Us</h4>
                            <p><a href="mailto:hello@every27.com">hello@every27.com</a> (General)</p>
                            <p><a href="mailto:support@every27.com">support@every27.com</a> (Support)</p>
                        </div>
                    </div>

                    <div class="contact-info-card mb-4">
                        <div class="contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h4>Call Us</h4>
                            <p>+234 XXX XXX XXXX</p>
                            <p>Mon - Fri, 8am - 6pm WAT</p>
                        </div>
                    </div>

                    <div class="contact-info-card mb-4">
                        <div class="contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h4>Visit Us</h4>
                            <p>Lagos, Nigeria</p>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="card reveal" style="background: var(--secondary-color); border: none;">
                    <div class="card-body">
                        <h3 style="margin-bottom: var(--spacing-lg);">Follow Us</h3>
                        <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg);">
                            Stay updated with the latest news and updates from Every27.
                        </p>
                        <div style="display: flex; gap: var(--spacing-md);">
                            <a href="#" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: var(--primary-color); border-radius: var(--radius-lg); color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                                </svg>
                            </a>
                            <a href="#" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: var(--primary-color); border-radius: var(--radius-lg); color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    <rect x="2" y="9" width="4" height="12"></rect>
                                    <circle cx="4" cy="4" r="2"></circle>
                                </svg>
                            </a>
                            <a href="#" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: var(--primary-color); border-radius: var(--radius-lg); color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                            <a href="#" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: var(--primary-color); border-radius: var(--radius-lg); color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="card reveal mt-4">
                    <div class="card-body">
                        <h3 style="margin-bottom: var(--spacing-lg);">Business Hours</h3>
                        <div style="display: flex; justify-content: space-between; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--gray-200);">
                            <span style="color: var(--gray-600);">Monday - Friday</span>
                            <span style="font-weight: 500;">8:00 AM - 6:00 PM</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--gray-200);">
                            <span style="color: var(--gray-600);">Saturday</span>
                            <span style="font-weight: 500;">9:00 AM - 2:00 PM</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: var(--spacing-sm) 0;">
                            <span style="color: var(--gray-600);">Sunday</span>
                            <span style="font-weight: 500; color: var(--error);">Closed</span>
                        </div>
                        <p style="font-size: 0.875rem; color: var(--gray-500); margin-top: var(--spacing-md); margin-bottom: 0;">
                            All times are in West Africa Time (WAT)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
