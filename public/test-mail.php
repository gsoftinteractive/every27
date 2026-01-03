<?php
/**
 * Every27 - Mail Test Script
 * Tests if PHP mail() function is working
 * DELETE THIS FILE AFTER TESTING!
 */

$test_email = 'business@every27.com'; // Change to your email to receive test
$result = '';
$success = false;

if (isset($_POST['test'])) {
    $to = $test_email;
    $subject = 'Every27 Mail Test - ' . date('Y-m-d H:i:s');
    $message = "This is a test email from Every27.\n\nIf you receive this, PHP mail() is working on your server.\n\nServer: " . $_SERVER['HTTP_HOST'] . "\nTime: " . date('F j, Y g:i:s A');
    $headers = "From: Every27 Test <noreply@every27.com>\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Try to send
    $mail_sent = @mail($to, $subject, $message, $headers);

    if ($mail_sent) {
        $success = true;
        $result = "Mail function returned SUCCESS. Check {$test_email} for the test email.";
    } else {
        $result = "Mail function returned FAILURE. PHP mail() is not working.";
    }
}

// Check mail configuration
$mail_config = [];
$mail_config['sendmail_path'] = ini_get('sendmail_path') ?: 'Not set';
$mail_config['SMTP'] = ini_get('SMTP') ?: 'Not set';
$mail_config['smtp_port'] = ini_get('smtp_port') ?: 'Not set';
$mail_config['sendmail_from'] = ini_get('sendmail_from') ?: 'Not set';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Test - Every27</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        h1 { color: #0E84F1; }
        .box { background: #f5f5f5; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .success { background: #D1FAE5; border: 1px solid #10B981; color: #065F46; }
        .error { background: #FEE2E2; border: 1px solid #EF4444; color: #B91C1C; }
        button { background: #0E84F1; color: white; border: none; padding: 12px 24px; font-size: 16px; border-radius: 6px; cursor: pointer; }
        button:hover { background: #0B6FCC; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        td:first-child { font-weight: bold; width: 40%; }
        .warning { background: #FEF3C7; border: 1px solid #F59E0B; color: #92400E; padding: 15px; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Every27 Mail Test</h1>

    <?php if ($result): ?>
        <div class="box <?php echo $success ? 'success' : 'error'; ?>">
            <strong><?php echo $success ? 'SUCCESS!' : 'FAILED!'; ?></strong><br>
            <?php echo $result; ?>
        </div>
    <?php endif; ?>

    <div class="box">
        <h3>Server Mail Configuration</h3>
        <table>
            <?php foreach ($mail_config as $key => $value): ?>
            <tr>
                <td><?php echo $key; ?></td>
                <td><?php echo $value; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td>PHP Version</td>
                <td><?php echo phpversion(); ?></td>
            </tr>
        </table>
    </div>

    <form method="POST">
        <p>Click the button to send a test email to: <strong><?php echo $test_email; ?></strong></p>
        <button type="submit" name="test" value="1">Send Test Email</button>
    </form>

    <div class="warning">
        <strong>Important:</strong> Delete this file after testing for security!<br>
        <code>rm test-mail.php</code>
    </div>

    <div class="box">
        <h3>If mail() doesn't work, options are:</h3>
        <ol>
            <li><strong>Contact hosting support</strong> - Ask them to enable PHP mail() or provide SMTP details</li>
            <li><strong>Use PHPMailer with SMTP</strong> - More reliable, works with Gmail</li>
            <li><strong>Use a transactional email service</strong> - SendGrid, Mailgun, etc.</li>
        </ol>
    </div>
</body>
</html>
