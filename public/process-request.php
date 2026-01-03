<?php
/**
 * Every27 - Process Access Request
 * Handles form submission, sends email notification
 */

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: request-access.php');
    exit;
}

// Get form data and sanitize
$company_name = htmlspecialchars(trim($_POST['company_name'] ?? ''));
$rc_number = htmlspecialchars(trim($_POST['rc_number'] ?? ''));
$contact_name = htmlspecialchars(trim($_POST['contact_name'] ?? ''));
$position = htmlspecialchars(trim($_POST['position'] ?? ''));
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
$employee_count = htmlspecialchars(trim($_POST['employee_count'] ?? ''));
$industry = htmlspecialchars(trim($_POST['industry'] ?? 'Not specified'));
$address = htmlspecialchars(trim($_POST['address'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? 'No additional information provided.'));

// Validate required fields
$errors = [];
if (empty($company_name)) $errors[] = 'Company name is required';
if (empty($rc_number)) $errors[] = 'RC/CAC number is required';
if (empty($contact_name)) $errors[] = 'Contact person name is required';
if (empty($position)) $errors[] = 'Position is required';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
if (empty($phone)) $errors[] = 'Phone number is required';
if (empty($employee_count)) $errors[] = 'Number of employees is required';
if (empty($address)) $errors[] = 'Company address is required';

// If there are errors, redirect back with error message
if (!empty($errors)) {
    $_SESSION['form_error'] = implode(', ', $errors);
    header('Location: request-access.php?error=1');
    exit;
}

// Prepare email content for admin
$admin_email = 'business@every27.com';
$subject = "New Access Request: {$company_name}";

$email_body = "
==============================================
NEW COMPANY ACCESS REQUEST
==============================================

COMPANY INFORMATION
-------------------
Company Name: {$company_name}
RC/CAC Number: {$rc_number}
Industry: {$industry}
Number of Employees: {$employee_count}
Address: {$address}

CONTACT PERSON
--------------
Name: {$contact_name}
Position: {$position}
Email: {$email}
Phone: {$phone}

ADDITIONAL INFORMATION
----------------------
{$message}

==============================================
Submitted: " . date('F j, Y \a\t g:i A') . "
==============================================

Action Required:
1. Review the company details
2. Contact them for CAC certificate/documentation
3. Process approval in admin dashboard

";

// Email headers
$headers = "From: Every27 <noreply@every27.com>\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email to admin
$email_sent = @mail($admin_email, $subject, $email_body, $headers);

// Also try to send confirmation to the company
$company_subject = "Every27 - We've Received Your Access Request";
$company_body = "
Dear {$contact_name},

Thank you for your interest in Every27!

We have received your access request for {$company_name}. Our team will review your application and get back to you within 1-3 business days.

What happens next:
1. Our team reviews your application
2. We may contact you for additional documentation (CAC certificate)
3. Once approved, you'll receive login credentials via email
4. You can then set up your company profile and add employees

If you have any questions in the meantime, please don't hesitate to contact us at business@every27.com.

Best regards,
The Every27 Team

--
Every27 - Your Salary, On Time, Every Time
https://every27.com
";

$company_headers = "From: Every27 <noreply@every27.com>\r\n";
$company_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

@mail($email, $company_subject, $company_body, $company_headers);

// Redirect to success page
header('Location: request-access.php?success=1');
exit;
