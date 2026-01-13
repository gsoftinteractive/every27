<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class EmployeeAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('employee_logged_in')) {
            return redirect()->to('/employee/login')->with('error', 'Please login to continue');
        }

        if ($session->get('employee_status') !== 'active') {
            $session->destroy();
            return redirect()->to('/employee/login')->with('error', 'Your account has been suspended');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
