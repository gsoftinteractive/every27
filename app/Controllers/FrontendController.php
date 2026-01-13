<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AccessRequestModel;
use App\Services\EmailService;

class FrontendController extends Controller
{
    /**
     * Serve static frontend pages from public folder
     */
    protected function servePage(string $page): string
    {
        $filePath = FCPATH . $page . '.php';

        if (!file_exists($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        ob_start();
        include $filePath;
        return ob_get_clean();
    }

    /**
     * Home page
     */
    public function index(): string
    {
        return $this->servePage('home');
    }

    /**
     * Login page
     */
    public function login(): string
    {
        return $this->servePage('login');
    }

    /**
     * Request access page
     */
    public function requestAccess(): string
    {
        return $this->servePage('request-access');
    }

    /**
     * Process access request form submission
     */
    public function submitAccessRequest()
    {
        // Get form data and sanitize
        $data = [
            'company_name'   => htmlspecialchars(trim($this->request->getPost('company_name') ?? '')),
            'rc_number'      => htmlspecialchars(trim($this->request->getPost('rc_number') ?? '')),
            'contact_name'   => htmlspecialchars(trim($this->request->getPost('contact_name') ?? '')),
            'position'       => htmlspecialchars(trim($this->request->getPost('position') ?? '')),
            'email'          => filter_var(trim($this->request->getPost('email') ?? ''), FILTER_SANITIZE_EMAIL),
            'phone'          => htmlspecialchars(trim($this->request->getPost('phone') ?? '')),
            'employee_count' => htmlspecialchars(trim($this->request->getPost('employee_count') ?? '')),
            'industry'       => htmlspecialchars(trim($this->request->getPost('industry') ?? 'Not specified')),
            'address'        => htmlspecialchars(trim($this->request->getPost('address') ?? '')),
            'message'        => htmlspecialchars(trim($this->request->getPost('message') ?? '')),
            'status'         => 'pending',
            'ip_address'     => $this->request->getIPAddress(),
        ];

        // Validate required fields
        $errors = [];
        if (empty($data['company_name'])) $errors[] = 'Company name is required';
        if (empty($data['rc_number'])) $errors[] = 'RC/CAC number is required';
        if (empty($data['contact_name'])) $errors[] = 'Contact person name is required';
        if (empty($data['position'])) $errors[] = 'Position is required';
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
        if (empty($data['phone'])) $errors[] = 'Phone number is required';
        if (empty($data['employee_count'])) $errors[] = 'Number of employees is required';
        if (empty($data['address'])) $errors[] = 'Company address is required';

        if (!empty($errors)) {
            return redirect()->to('/request-access?error=1');
        }

        try {
            $accessRequestModel = new AccessRequestModel();

            // Disable validation to avoid silent failures - we already validated above
            $accessRequestModel->skipValidation(true);

            $requestId = $accessRequestModel->insert($data);

            if (!$requestId) {
                log_message('error', 'Access request insert failed: ' . json_encode($accessRequestModel->errors()));
                return redirect()->to('/request-access?error=1');
            }

            // Send email notification to admin
            try {
                $emailService = new EmailService();
                $adminEmail = 'business@every27.com';
                $subject = "New Access Request: {$data['company_name']}";
                $body = "
                <h2>New Company Access Request</h2>
                <p>A new company has requested access to Every27.</p>

                <h3>Company Information</h3>
                <ul>
                    <li><strong>Company Name:</strong> {$data['company_name']}</li>
                    <li><strong>RC/CAC Number:</strong> {$data['rc_number']}</li>
                    <li><strong>Industry:</strong> {$data['industry']}</li>
                    <li><strong>Number of Employees:</strong> {$data['employee_count']}</li>
                    <li><strong>Address:</strong> {$data['address']}</li>
                </ul>

                <h3>Contact Person</h3>
                <ul>
                    <li><strong>Name:</strong> {$data['contact_name']}</li>
                    <li><strong>Position:</strong> {$data['position']}</li>
                    <li><strong>Email:</strong> {$data['email']}</li>
                    <li><strong>Phone:</strong> {$data['phone']}</li>
                </ul>

                <h3>Additional Information</h3>
                <p>" . nl2br($data['message'] ?: 'None provided') . "</p>

                <hr>
                <p><a href='" . base_url('admin/access-requests/' . $requestId) . "'>View in Admin Dashboard</a></p>
                ";

                $emailService->send($adminEmail, $subject, $body);
            } catch (\Exception $e) {
                log_message('error', 'Failed to send admin notification: ' . $e->getMessage());
            }

            // Send confirmation to company
            try {
                $emailService = new EmailService();
                $emailService->sendAccessRequestConfirmation([
                    'company_name'  => $data['company_name'],
                    'contact_name'  => $data['contact_name'],
                    'email'         => $data['email'],
                ]);
            } catch (\Exception $e) {
                log_message('error', 'Failed to send confirmation email: ' . $e->getMessage());
            }

            return redirect()->to('/request-access?success=1');

        } catch (\Exception $e) {
            log_message('error', 'Access request error: ' . $e->getMessage());
            return redirect()->to('/request-access?error=1');
        }
    }

    /**
     * About page
     */
    public function about(): string
    {
        return $this->servePage('about');
    }

    /**
     * Services page
     */
    public function services(): string
    {
        return $this->servePage('services');
    }

    /**
     * Pricing page
     */
    public function pricing(): string
    {
        return $this->servePage('pricing');
    }

    /**
     * Contact page
     */
    public function contact(): string
    {
        return $this->servePage('contact');
    }

    /**
     * Privacy page
     */
    public function privacy(): string
    {
        return $this->servePage('privacy');
    }

    /**
     * Terms page
     */
    public function terms(): string
    {
        return $this->servePage('terms');
    }

    /**
     * Features page
     */
    public function features(): string
    {
        return $this->servePage('features');
    }

    /**
     * FAQ page
     */
    public function faq(): string
    {
        return $this->servePage('faq');
    }

    /**
     * Help page
     */
    public function help(): string
    {
        return $this->servePage('help');
    }

    /**
     * Security page
     */
    public function security(): string
    {
        return $this->servePage('security');
    }

    /**
     * Cookies page
     */
    public function cookies(): string
    {
        return $this->servePage('cookies');
    }
}
