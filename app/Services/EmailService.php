<?php

namespace App\Services;

use CodeIgniter\Email\Email;

class EmailService
{
    protected Email $email;
    protected string $fromEmail = 'noreply@every27.com';
    protected string $fromName = 'Every27';

    public function __construct()
    {
        $this->email = \Config\Services::email();

        // Configure email settings
        $this->email->setFrom($this->fromEmail, $this->fromName);
        $this->email->setMailType('html');
    }

    /**
     * Send withdrawal request notification to admin
     */
    public function sendWithdrawalRequestToAdmin(array $withdrawal, array $employee): bool
    {
        $adminEmails = $this->getAdminEmails();
        if (empty($adminEmails)) {
            return false;
        }

        $subject = 'New Withdrawal Request - ' . $withdrawal['reference'];
        $message = $this->buildEmailTemplate('withdrawal_request_admin', [
            'withdrawal' => $withdrawal,
            'employee'   => $employee,
        ]);

        return $this->send($adminEmails, $subject, $message);
    }

    /**
     * Send withdrawal completed notification to employee
     */
    public function sendWithdrawalCompleted(array $withdrawal, array $employee): bool
    {
        $subject = 'Withdrawal Completed - ' . $withdrawal['reference'];
        $message = $this->buildEmailTemplate('withdrawal_completed', [
            'withdrawal' => $withdrawal,
            'employee'   => $employee,
        ]);

        return $this->send($employee['email'], $subject, $message);
    }

    /**
     * Send withdrawal rejected notification to employee
     */
    public function sendWithdrawalRejected(array $withdrawal, array $employee): bool
    {
        $subject = 'Withdrawal Request Rejected - ' . $withdrawal['reference'];
        $message = $this->buildEmailTemplate('withdrawal_rejected', [
            'withdrawal' => $withdrawal,
            'employee'   => $employee,
        ]);

        return $this->send($employee['email'], $subject, $message);
    }

    /**
     * Send funding request notification to admin
     */
    public function sendFundingRequestToAdmin(array $funding, array $company): bool
    {
        $adminEmails = $this->getAdminEmails();
        if (empty($adminEmails)) {
            return false;
        }

        $subject = 'New Funding Request - ' . $funding['reference'];
        $message = $this->buildEmailTemplate('funding_request_admin', [
            'funding' => $funding,
            'company' => $company,
        ]);

        return $this->send($adminEmails, $subject, $message);
    }

    /**
     * Send funding approved notification to company
     */
    public function sendFundingApproved(array $funding, array $company): bool
    {
        $subject = 'Wallet Funded - ' . $funding['reference'];
        $message = $this->buildEmailTemplate('funding_approved', [
            'funding' => $funding,
            'company' => $company,
        ]);

        return $this->send($company['email'], $subject, $message);
    }

    /**
     * Send funding rejected notification to company
     */
    public function sendFundingRejected(array $funding, array $company): bool
    {
        $subject = 'Funding Request Rejected - ' . $funding['reference'];
        $message = $this->buildEmailTemplate('funding_rejected', [
            'funding' => $funding,
            'company' => $company,
        ]);

        return $this->send($company['email'], $subject, $message);
    }

    /**
     * Send salary advance request notification to company
     */
    public function sendAdvanceRequestToCompany(array $advance, array $employee, array $company): bool
    {
        $subject = 'New Salary Advance Request - ' . $advance['reference'];
        $message = $this->buildEmailTemplate('advance_request_company', [
            'advance'  => $advance,
            'employee' => $employee,
            'company'  => $company,
        ]);

        return $this->send($company['email'], $subject, $message);
    }

    /**
     * Send salary advance approved notification to employee
     */
    public function sendAdvanceApproved(array $advance, array $employee): bool
    {
        $subject = 'Salary Advance Approved - ' . $advance['reference'];
        $message = $this->buildEmailTemplate('advance_approved', [
            'advance'  => $advance,
            'employee' => $employee,
        ]);

        return $this->send($employee['email'], $subject, $message);
    }

    /**
     * Send salary advance rejected notification to employee
     */
    public function sendAdvanceRejected(array $advance, array $employee): bool
    {
        $subject = 'Salary Advance Rejected - ' . $advance['reference'];
        $message = $this->buildEmailTemplate('advance_rejected', [
            'advance'  => $advance,
            'employee' => $employee,
        ]);

        return $this->send($employee['email'], $subject, $message);
    }

    /**
     * Send payroll processed notification
     */
    public function sendPayrollProcessed(array $payroll, array $company): bool
    {
        $subject = 'Payroll Processed - ' . $payroll['reference'];
        $message = $this->buildEmailTemplate('payroll_processed', [
            'payroll' => $payroll,
            'company' => $company,
        ]);

        return $this->send($company['email'], $subject, $message);
    }

    /**
     * Send salary credited notification to employee
     */
    public function sendSalaryCredited(array $employee, float $amount, string $month): bool
    {
        $subject = 'Salary Credited - ' . $month;
        $message = $this->buildEmailTemplate('salary_credited', [
            'employee' => $employee,
            'amount'   => $amount,
            'month'    => $month,
        ]);

        return $this->send($employee['email'], $subject, $message);
    }

    /**
     * Send welcome email to new employee
     */
    public function sendWelcomeEmployee(array $employee, string $password): bool
    {
        $subject = 'Welcome to Every27 - Your Account Details';
        $message = $this->buildEmailTemplate('welcome_employee', [
            'employee' => $employee,
            'password' => $password,
        ]);

        return $this->send($employee['email'], $subject, $message);
    }

    /**
     * Send welcome email to new company
     */
    public function sendWelcomeCompany(array $company, string $password): bool
    {
        $subject = 'Welcome to Every27 - Your Account Details';
        $message = $this->buildEmailTemplate('welcome_company', [
            'company'  => $company,
            'password' => $password,
        ]);

        return $this->send($company['email'], $subject, $message);
    }

    /**
     * Send access request confirmation to company
     */
    public function sendAccessRequestConfirmation(array $data): bool
    {
        $subject = 'Access Request Received - Every27';
        $content = '
            <h2>Thank You for Your Interest!</h2>
            <p>Hi ' . esc($data['contact_name']) . ',</p>
            <p>We have received your access request for <strong>' . esc($data['company_name']) . '</strong>.</p>

            <div class="info-box">
                <p>Our team will review your application and get back to you within 1-2 business days.</p>
            </div>

            <p>In the meantime, if you have any questions, feel free to contact us at <a href="mailto:business@every27.com">business@every27.com</a>.</p>

            <p>Thank you for choosing Every27!</p>
        ';

        $message = $this->wrapInTemplate('Access Request Received', $content);

        return $this->send($data['email'], $subject, $message);
    }

    /**
     * Build email template
     */
    protected function buildEmailTemplate(string $template, array $data): string
    {
        $templates = [
            'withdrawal_request_admin' => $this->getWithdrawalRequestAdminTemplate($data),
            'withdrawal_completed'     => $this->getWithdrawalCompletedTemplate($data),
            'withdrawal_rejected'      => $this->getWithdrawalRejectedTemplate($data),
            'funding_request_admin'    => $this->getFundingRequestAdminTemplate($data),
            'funding_approved'         => $this->getFundingApprovedTemplate($data),
            'funding_rejected'         => $this->getFundingRejectedTemplate($data),
            'advance_request_company'  => $this->getAdvanceRequestCompanyTemplate($data),
            'advance_approved'         => $this->getAdvanceApprovedTemplate($data),
            'advance_rejected'         => $this->getAdvanceRejectedTemplate($data),
            'payroll_processed'        => $this->getPayrollProcessedTemplate($data),
            'salary_credited'          => $this->getSalaryCreditedTemplate($data),
            'welcome_employee'         => $this->getWelcomeEmployeeTemplate($data),
            'welcome_company'          => $this->getWelcomeCompanyTemplate($data),
        ];

        return $templates[$template] ?? '';
    }

    /**
     * Send email
     */
    public function send($to, string $subject, string $message): bool
    {
        try {
            $this->email->setTo($to);
            $this->email->setSubject($subject);
            $this->email->setMessage($message);

            return $this->email->send();
        } catch (\Exception $e) {
            log_message('error', 'Email sending failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get admin emails
     */
    protected function getAdminEmails(): array
    {
        $adminModel = new \App\Models\AdminUserModel();
        $admins = $adminModel->where('status', 'active')->findAll();

        return array_column($admins, 'email');
    }

    /**
     * Get base email template wrapper
     */
    protected function wrapInTemplate(string $title, string $content): string
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . $title . '</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f5f5f5; }
                .container { max-width: 600px; margin: 0 auto; background: #fff; }
                .header { background: #0E84F1; padding: 20px; text-align: center; }
                .header h1 { color: #fff; margin: 0; font-size: 24px; }
                .content { padding: 30px; }
                .footer { background: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #666; }
                .btn { display: inline-block; padding: 12px 24px; background: #0E84F1; color: #fff; text-decoration: none; border-radius: 6px; margin: 20px 0; }
                .info-box { background: #f0f7ff; padding: 15px; border-radius: 8px; margin: 15px 0; }
                .warning-box { background: #fff3cd; padding: 15px; border-radius: 8px; margin: 15px 0; }
                .success-box { background: #d4edda; padding: 15px; border-radius: 8px; margin: 15px 0; }
                .danger-box { background: #f8d7da; padding: 15px; border-radius: 8px; margin: 15px 0; }
                h2 { color: #0E84F1; }
                .amount { font-size: 24px; font-weight: bold; color: #0E84F1; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Every27</h1>
                </div>
                <div class="content">
                    ' . $content . '
                </div>
                <div class="footer">
                    <p>&copy; ' . date('Y') . ' Every27. All rights reserved.</p>
                    <p>This is an automated message, please do not reply.</p>
                </div>
            </div>
        </body>
        </html>';
    }

    // Template methods
    protected function getWithdrawalRequestAdminTemplate(array $data): string
    {
        $withdrawal = $data['withdrawal'];
        $employee = $data['employee'];

        $content = '
            <h2>New Withdrawal Request</h2>
            <p>A new withdrawal request has been submitted and requires your attention.</p>

            <div class="info-box">
                <p><strong>Reference:</strong> ' . esc($withdrawal['reference']) . '</p>
                <p><strong>Employee:</strong> ' . esc($employee['first_name'] . ' ' . $employee['last_name']) . '</p>
                <p><strong>Amount:</strong> <span class="amount">NGN ' . number_format($withdrawal['amount'], 2) . '</span></p>
            </div>

            <h3>Bank Details</h3>
            <div class="info-box">
                <p><strong>Bank:</strong> ' . esc($withdrawal['bank_name']) . '</p>
                <p><strong>Account Number:</strong> ' . esc($withdrawal['account_number']) . '</p>
                <p><strong>Account Name:</strong> ' . esc($withdrawal['account_name']) . '</p>
            </div>

            <p><a href="' . base_url('admin/withdrawals/' . $withdrawal['id']) . '" class="btn">View Request</a></p>
        ';

        return $this->wrapInTemplate('New Withdrawal Request', $content);
    }

    protected function getWithdrawalCompletedTemplate(array $data): string
    {
        $withdrawal = $data['withdrawal'];
        $employee = $data['employee'];

        $content = '
            <h2>Withdrawal Completed</h2>
            <p>Hi ' . esc($employee['first_name']) . ',</p>
            <p>Great news! Your withdrawal request has been processed and the funds have been transferred to your bank account.</p>

            <div class="success-box">
                <p><strong>Reference:</strong> ' . esc($withdrawal['reference']) . '</p>
                <p><strong>Amount:</strong> <span class="amount">NGN ' . number_format($withdrawal['amount'], 2) . '</span></p>
                <p><strong>Bank:</strong> ' . esc($withdrawal['bank_name']) . '</p>
                <p><strong>Account:</strong> ' . esc($withdrawal['account_number']) . '</p>
            </div>

            <p>Please allow 1-2 business days for the transfer to reflect in your account.</p>
        ';

        return $this->wrapInTemplate('Withdrawal Completed', $content);
    }

    protected function getWithdrawalRejectedTemplate(array $data): string
    {
        $withdrawal = $data['withdrawal'];
        $employee = $data['employee'];

        $content = '
            <h2>Withdrawal Request Rejected</h2>
            <p>Hi ' . esc($employee['first_name']) . ',</p>
            <p>Unfortunately, your withdrawal request could not be processed.</p>

            <div class="danger-box">
                <p><strong>Reference:</strong> ' . esc($withdrawal['reference']) . '</p>
                <p><strong>Amount:</strong> NGN ' . number_format($withdrawal['amount'], 2) . '</p>
                <p><strong>Reason:</strong> ' . esc($withdrawal['admin_notes'] ?? 'Not specified') . '</p>
            </div>

            <p>If you have any questions, please contact your employer or our support team.</p>
        ';

        return $this->wrapInTemplate('Withdrawal Rejected', $content);
    }

    protected function getFundingRequestAdminTemplate(array $data): string
    {
        $funding = $data['funding'];
        $company = $data['company'];

        $content = '
            <h2>New Funding Request</h2>
            <p>A new funding request has been submitted with a payment receipt.</p>

            <div class="info-box">
                <p><strong>Reference:</strong> ' . esc($funding['reference']) . '</p>
                <p><strong>Company:</strong> ' . esc($company['name']) . '</p>
                <p><strong>Amount:</strong> <span class="amount">NGN ' . number_format($funding['amount'], 2) . '</span></p>
            </div>

            <h3>Transfer Details</h3>
            <div class="info-box">
                <p><strong>Sender Bank:</strong> ' . esc($funding['sender_bank']) . '</p>
                <p><strong>Account Name:</strong> ' . esc($funding['sender_account_name']) . '</p>
                <p><strong>Transfer Reference:</strong> ' . esc($funding['transfer_reference'] ?? 'N/A') . '</p>
            </div>

            <p><a href="' . base_url('admin/fundings/' . $funding['id']) . '" class="btn">Review Request</a></p>
        ';

        return $this->wrapInTemplate('New Funding Request', $content);
    }

    protected function getFundingApprovedTemplate(array $data): string
    {
        $funding = $data['funding'];
        $company = $data['company'];

        $content = '
            <h2>Wallet Funded Successfully</h2>
            <p>Hi ' . esc($company['name']) . ',</p>
            <p>Great news! Your funding request has been approved and your wallet has been credited.</p>

            <div class="success-box">
                <p><strong>Reference:</strong> ' . esc($funding['reference']) . '</p>
                <p><strong>Amount Credited:</strong> <span class="amount">NGN ' . number_format($funding['amount'], 2) . '</span></p>
            </div>

            <p><a href="' . base_url('company/wallet') . '" class="btn">View Wallet</a></p>
        ';

        return $this->wrapInTemplate('Wallet Funded', $content);
    }

    protected function getFundingRejectedTemplate(array $data): string
    {
        $funding = $data['funding'];
        $company = $data['company'];

        $content = '
            <h2>Funding Request Rejected</h2>
            <p>Hi ' . esc($company['name']) . ',</p>
            <p>Unfortunately, your funding request could not be approved.</p>

            <div class="danger-box">
                <p><strong>Reference:</strong> ' . esc($funding['reference']) . '</p>
                <p><strong>Amount:</strong> NGN ' . number_format($funding['amount'], 2) . '</p>
                <p><strong>Reason:</strong> ' . esc($funding['admin_notes'] ?? 'Not specified') . '</p>
            </div>

            <p>Please contact support if you believe this is an error.</p>
        ';

        return $this->wrapInTemplate('Funding Rejected', $content);
    }

    protected function getAdvanceRequestCompanyTemplate(array $data): string
    {
        $advance = $data['advance'];
        $employee = $data['employee'];
        $company = $data['company'];

        $content = '
            <h2>New Salary Advance Request</h2>
            <p>Hi ' . esc($company['name']) . ',</p>
            <p>An employee has requested a salary advance.</p>

            <div class="info-box">
                <p><strong>Reference:</strong> ' . esc($advance['reference']) . '</p>
                <p><strong>Employee:</strong> ' . esc($employee['first_name'] . ' ' . $employee['last_name']) . '</p>
                <p><strong>Amount Requested:</strong> <span class="amount">NGN ' . number_format($advance['amount_requested'], 2) . '</span></p>
                <p><strong>Monthly Salary:</strong> NGN ' . number_format($advance['monthly_salary'], 2) . '</p>
                <p><strong>Percentage:</strong> ' . number_format($advance['percentage_of_salary'], 1) . '%</p>
            </div>

            <p><a href="' . base_url('company/advances/' . $advance['id']) . '" class="btn">Review Request</a></p>
        ';

        return $this->wrapInTemplate('New Salary Advance Request', $content);
    }

    protected function getAdvanceApprovedTemplate(array $data): string
    {
        $advance = $data['advance'];
        $employee = $data['employee'];

        $content = '
            <h2>Salary Advance Approved</h2>
            <p>Hi ' . esc($employee['first_name']) . ',</p>
            <p>Great news! Your salary advance request has been approved.</p>

            <div class="success-box">
                <p><strong>Reference:</strong> ' . esc($advance['reference']) . '</p>
                <p><strong>Amount Approved:</strong> <span class="amount">NGN ' . number_format($advance['amount_approved'], 2) . '</span></p>
                <p><strong>Fee (7%):</strong> NGN ' . number_format($advance['fee_amount'], 2) . '</p>
                <p><strong>Total Repayment:</strong> NGN ' . number_format($advance['total_repayment'], 2) . '</p>
            </div>

            <p>The approved amount will be credited to your wallet shortly.</p>
        ';

        return $this->wrapInTemplate('Salary Advance Approved', $content);
    }

    protected function getAdvanceRejectedTemplate(array $data): string
    {
        $advance = $data['advance'];
        $employee = $data['employee'];

        $content = '
            <h2>Salary Advance Rejected</h2>
            <p>Hi ' . esc($employee['first_name']) . ',</p>
            <p>Unfortunately, your salary advance request has been rejected.</p>

            <div class="danger-box">
                <p><strong>Reference:</strong> ' . esc($advance['reference']) . '</p>
                <p><strong>Amount Requested:</strong> NGN ' . number_format($advance['amount_requested'], 2) . '</p>
                <p><strong>Reason:</strong> ' . esc($advance['approval_notes'] ?? 'Not specified') . '</p>
            </div>

            <p>If you have questions, please contact your employer.</p>
        ';

        return $this->wrapInTemplate('Salary Advance Rejected', $content);
    }

    protected function getPayrollProcessedTemplate(array $data): string
    {
        $payroll = $data['payroll'];
        $company = $data['company'];

        $content = '
            <h2>Payroll Processed</h2>
            <p>Hi ' . esc($company['name']) . ',</p>
            <p>Your payroll has been processed successfully.</p>

            <div class="success-box">
                <p><strong>Reference:</strong> ' . esc($payroll['reference']) . '</p>
                <p><strong>Month:</strong> ' . esc($payroll['payroll_month']) . '</p>
                <p><strong>Employees Paid:</strong> ' . $payroll['total_employees'] . '</p>
                <p><strong>Total Net Salary:</strong> NGN ' . number_format($payroll['total_net_salary'], 2) . '</p>
                <p><strong>Total Deducted:</strong> NGN ' . number_format($payroll['total_amount'], 2) . '</p>
            </div>

            <p><a href="' . base_url('company/payroll/' . $payroll['id']) . '" class="btn">View Details</a></p>
        ';

        return $this->wrapInTemplate('Payroll Processed', $content);
    }

    protected function getSalaryCreditedTemplate(array $data): string
    {
        $employee = $data['employee'];
        $amount = $data['amount'];
        $month = $data['month'];

        $content = '
            <h2>Salary Credited</h2>
            <p>Hi ' . esc($employee['first_name']) . ',</p>
            <p>Your salary for ' . $month . ' has been credited to your wallet.</p>

            <div class="success-box">
                <p><strong>Amount:</strong> <span class="amount">NGN ' . number_format($amount, 2) . '</span></p>
            </div>

            <p><a href="' . base_url('employee/wallet') . '" class="btn">View Wallet</a></p>
        ';

        return $this->wrapInTemplate('Salary Credited', $content);
    }

    protected function getWelcomeEmployeeTemplate(array $data): string
    {
        $employee = $data['employee'];
        $password = $data['password'];

        $content = '
            <h2>Welcome to Every27!</h2>
            <p>Hi ' . esc($employee['first_name']) . ',</p>
            <p>Your employer has added you to Every27. You can now access your salary, request advances, and manage your finances.</p>

            <div class="info-box">
                <p><strong>Email:</strong> ' . esc($employee['email']) . '</p>
                <p><strong>Password:</strong> ' . $password . '</p>
            </div>

            <div class="warning-box">
                <p><strong>Important:</strong> Please change your password after your first login.</p>
            </div>

            <p><a href="' . base_url('employee/login') . '" class="btn">Login Now</a></p>
        ';

        return $this->wrapInTemplate('Welcome to Every27', $content);
    }

    protected function getWelcomeCompanyTemplate(array $data): string
    {
        $company = $data['company'];
        $password = $data['password'];

        $content = '
            <h2>Welcome to Every27!</h2>
            <p>Hi ' . esc($company['name']) . ',</p>
            <p>Your account has been created. You can now manage your employees, run payroll, and streamline your salary payments.</p>

            <div class="info-box">
                <p><strong>Email:</strong> ' . esc($company['email']) . '</p>
                <p><strong>Password:</strong> ' . $password . '</p>
            </div>

            <div class="warning-box">
                <p><strong>Important:</strong> Please change your password after your first login.</p>
            </div>

            <p><a href="' . base_url('company/login') . '" class="btn">Login Now</a></p>
        ';

        return $this->wrapInTemplate('Welcome to Every27', $content);
    }
}
