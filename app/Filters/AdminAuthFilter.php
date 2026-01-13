<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Please login to continue');
        }

        if ($session->get('admin_status') !== 'active') {
            $session->destroy();
            return redirect()->to('/admin/login')->with('error', 'Your account has been suspended');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
