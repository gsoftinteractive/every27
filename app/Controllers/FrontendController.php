<?php

namespace App\Controllers;

use CodeIgniter\Controller;

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
