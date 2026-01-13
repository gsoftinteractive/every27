<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CompanyAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('company_logged_in')) {
            return redirect()->to('/company/login')->with('error', 'Please login to continue');
        }

        if ($session->get('company_status') !== 'active') {
            $session->destroy();
            return redirect()->to('/company/login')->with('error', 'Your company account has been suspended');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
