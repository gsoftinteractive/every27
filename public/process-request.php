<?php
/**
 * Every27 - Process Access Request
 * Handles form submission, saves to database, sends email notification
 */

// Bootstrap CodeIgniter to use models
require_once __DIR__ . '/../app/Config/Paths.php';
$paths = new Config\Paths();
require_once $paths->systemDirectory . '/Boot.php';

// Initialize CI4
$app = \Config\Services::codeigniter();
$app->initialize();

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: request-access');
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
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

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
    header('Location: request-access?error=1');
    exit;
}

// Save to database
try {
    $accessRequestModel = new \App\Models\AccessRequestModel();

    $data = [
        'company_name'   => $company_name,
        'rc_number'      => $rc_number,
        'contact_name'   => $contact_name,
        'position'       => $position,
        'email'          => $email,
        'phone'          => $phone,
        'employee_count' => $employee_count,
        'industry'       => $industry,
        'address'        => $address,
        'message'        => $message,
        'status'         => 'pending',
        'ip_address'     => $_SERVER['REMOTE_ADDR'] ?? null,
    ];

    $requestId = $accessRequestModel->insert($data);

    if (!$requestId) {
        throw new Exception('Failed to save request');
    }

    // Send email notification to admin
    $emailService = new \App\Services\EmailService();

    // Try to send admin notification
    try {
        $adminEmail = 'business@every27.com';
        $subject = "New Access Request: {$company_name}";
        $body = "
        <h2>New Company Access Request</h2>
        <p>A new company has requested access to Every27.</p>

        <h3>Company Information</h3>
        <ul>
            <li><strong>Company Name:</strong> {$company_name}</li>
            <li><strong>RC/CAC Number:</strong> {$rc_number}</li>
            <li><strong>Industry:</strong> {$industry}</li>
            <li><strong>Number of Employees:</strong> {$employee_count}</li>
            <li><strong>Address:</strong> {$address}</li>
        </ul>

        <h3>Contact Person</h3>
        <ul>
            <li><strong>Name:</strong> {$contact_name}</li>
            <li><strong>Position:</strong> {$position}</li>
            <li><strong>Email:</strong> {$email}</li>
            <li><strong>Phone:</strong> {$phone}</li>
        </ul>

        <h3>Additional Information</h3>
        <p>" . nl2br($message ?: 'None provided') . "</p>

        <hr>
        <p><a href='" . base_url('admin/access-requests/' . $requestId) . "'>View in Admin Dashboard</a></p>
        ";

        $emailService->send($adminEmail, $subject, $body);
    } catch (Exception $e) {
        // Log but don't fail if email fails
        log_message('error', 'Failed to send admin notification: ' . $e->getMessage());
    }

    // Send confirmation to company
    try {
        $emailService->sendAccessRequestConfirmation([
            'company_name'  => $company_name,
            'contact_name'  => $contact_name,
            'email'         => $email,
        ]);
    } catch (Exception $e) {
        log_message('error', 'Failed to send confirmation email: ' . $e->getMessage());
    }

    // Redirect to success page
    header('Location: request-access?success=1');
    exit;

} catch (Exception $e) {
    log_message('error', 'Access request error: ' . $e->getMessage());
    header('Location: request-access?error=1');
    exit;
}
