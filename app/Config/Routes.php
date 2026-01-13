<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ============================================
// Frontend Routes (Static Pages)
// ============================================
$routes->get('/', 'FrontendController::index');
$routes->get('login', 'FrontendController::login');
$routes->get('request-access', 'FrontendController::requestAccess');
$routes->post('request-access', 'FrontendController::submitAccessRequest');
$routes->get('about', 'FrontendController::about');
$routes->get('services', 'FrontendController::services');
$routes->get('pricing', 'FrontendController::pricing');
$routes->get('contact', 'FrontendController::contact');
$routes->get('privacy', 'FrontendController::privacy');
$routes->get('terms', 'FrontendController::terms');
$routes->get('features', 'FrontendController::features');
$routes->get('faq', 'FrontendController::faq');
$routes->get('help', 'FrontendController::help');
$routes->get('security', 'FrontendController::security');
$routes->get('cookies', 'FrontendController::cookies');

// ============================================
// API Routes
// ============================================
$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    $routes->post('login', 'AuthController::login');
    $routes->post('request-access', 'AccessRequestController::submit');
});

// ============================================
// Admin Routes
// ============================================
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    // Public routes (no auth required)
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Protected routes (require admin auth)
    $routes->group('', ['filter' => 'adminAuth'], static function ($routes) {
        $routes->get('/', 'DashboardController::index');
        $routes->get('dashboard', 'DashboardController::index');

        // Access Requests Management
        $routes->get('access-requests', 'AccessRequestController::index');
        $routes->get('access-requests/(:num)', 'AccessRequestController::view/$1');
        $routes->post('access-requests/(:num)/contact', 'AccessRequestController::markContacted/$1');
        $routes->post('access-requests/(:num)/approve', 'AccessRequestController::approve/$1');
        $routes->post('access-requests/(:num)/reject', 'AccessRequestController::reject/$1');

        // Companies Management
        $routes->get('companies', 'CompanyController::index');
        $routes->get('companies/create', 'CompanyController::create');
        $routes->post('companies/create', 'CompanyController::store');
        $routes->get('companies/(:num)', 'CompanyController::view/$1');
        $routes->post('companies/(:num)/verify', 'CompanyController::verify/$1');
        $routes->post('companies/(:num)/reject', 'CompanyController::rejectVerification/$1');
        $routes->post('companies/(:num)/suspend', 'CompanyController::suspend/$1');
        $routes->post('companies/(:num)/activate', 'CompanyController::activate/$1');

        // Employees Management
        $routes->get('employees', 'EmployeeController::index');
        $routes->get('employees/(:num)', 'EmployeeController::view/$1');

        // Transactions
        $routes->get('transactions', 'TransactionController::index');

        // Salary Advances
        $routes->get('advances', 'AdvanceController::index');
        $routes->get('advances/(:num)', 'AdvanceController::view/$1');

        // Payroll
        $routes->get('payroll', 'PayrollController::index');
        $routes->get('payroll/(:num)', 'PayrollController::view/$1');

        // Withdrawal Requests Management
        $routes->get('withdrawals', 'WithdrawalController::index');
        $routes->get('withdrawals/(:num)', 'WithdrawalController::view/$1');
        $routes->post('withdrawals/(:num)/approve', 'WithdrawalController::approve/$1');
        $routes->post('withdrawals/(:num)/reject', 'WithdrawalController::reject/$1');

        // Funding Requests Management
        $routes->get('fundings', 'FundingController::index');
        $routes->get('fundings/(:num)', 'FundingController::view/$1');
        $routes->get('fundings/(:num)/receipt', 'FundingController::viewReceipt/$1');
        $routes->post('fundings/(:num)/approve', 'FundingController::approve/$1');
        $routes->post('fundings/(:num)/reject', 'FundingController::reject/$1');

        // Settings
        $routes->get('settings', 'SettingsController::index');
        $routes->post('settings', 'SettingsController::update');

        // Admin Users
        $routes->get('users', 'AdminUserController::index');
        $routes->get('users/create', 'AdminUserController::create');
        $routes->post('users/create', 'AdminUserController::store');
        $routes->get('users/(:num)', 'AdminUserController::edit/$1');
        $routes->post('users/(:num)', 'AdminUserController::update/$1');
        $routes->delete('users/(:num)', 'AdminUserController::delete/$1');
    });
});

// ============================================
// Company Routes
// ============================================
$routes->group('company', ['namespace' => 'App\Controllers\Company'], static function ($routes) {
    // Public routes (no auth required)
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('forgot-password', 'AuthController::forgotPassword');
    $routes->post('forgot-password', 'AuthController::sendResetLink');

    // Protected routes (require company auth)
    $routes->group('', ['filter' => 'companyAuth'], static function ($routes) {
        $routes->get('/', 'DashboardController::index');
        $routes->get('dashboard', 'DashboardController::index');

        // Profile
        $routes->get('profile', 'ProfileController::index');
        $routes->post('profile', 'ProfileController::update');
        $routes->post('profile/password', 'ProfileController::updatePassword');
        $routes->post('profile/documents', 'ProfileController::uploadDocuments');

        // Employees
        $routes->get('employees', 'EmployeeController::index');
        $routes->get('employees/create', 'EmployeeController::create');
        $routes->post('employees/create', 'EmployeeController::store');
        $routes->get('employees/(:num)', 'EmployeeController::view/$1');
        $routes->get('employees/(:num)/edit', 'EmployeeController::edit/$1');
        $routes->post('employees/(:num)/edit', 'EmployeeController::update/$1');
        $routes->post('employees/(:num)/deactivate', 'EmployeeController::deactivate/$1');
        $routes->post('employees/(:num)/activate', 'EmployeeController::activate/$1');
        $routes->post('employees/import', 'EmployeeController::import');

        // Wallet
        $routes->get('wallet', 'WalletController::index');
        $routes->get('wallet/fund', 'WalletController::fund');
        $routes->post('wallet/fund', 'WalletController::processFunding');
        $routes->get('wallet/fundings', 'WalletController::fundings');
        $routes->get('wallet/transactions', 'WalletController::transactions');

        // Payroll
        $routes->get('payroll', 'PayrollController::index');
        $routes->get('payroll/create', 'PayrollController::create');
        $routes->post('payroll/create', 'PayrollController::store');
        $routes->get('payroll/(:num)', 'PayrollController::view/$1');
        $routes->post('payroll/(:num)/process', 'PayrollController::process/$1');
        $routes->post('payroll/(:num)/cancel', 'PayrollController::cancel/$1');

        // Salary Advances
        $routes->get('advances', 'AdvanceController::index');
        $routes->get('advances/(:num)', 'AdvanceController::view/$1');
        $routes->post('advances/(:num)/approve', 'AdvanceController::approve/$1');
        $routes->post('advances/(:num)/reject', 'AdvanceController::reject/$1');

        // Reports
        $routes->get('reports', 'ReportController::index');
        $routes->get('reports/payroll', 'ReportController::payroll');
        $routes->get('reports/employees', 'ReportController::employees');
        $routes->get('reports/transactions', 'ReportController::transactions');
    });
});

// ============================================
// Employee Routes
// ============================================
$routes->group('employee', ['namespace' => 'App\Controllers\Employee'], static function ($routes) {
    // Public routes (no auth required)
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('forgot-password', 'AuthController::forgotPassword');
    $routes->post('forgot-password', 'AuthController::sendResetLink');

    // Protected routes (require employee auth)
    $routes->group('', ['filter' => 'employeeAuth'], static function ($routes) {
        $routes->get('/', 'DashboardController::index');
        $routes->get('dashboard', 'DashboardController::index');

        // Profile
        $routes->get('profile', 'ProfileController::index');
        $routes->post('profile', 'ProfileController::update');
        $routes->post('profile/password', 'ProfileController::updatePassword');
        $routes->post('profile/bank', 'ProfileController::updateBankDetails');

        // Wallet
        $routes->get('wallet', 'WalletController::index');
        $routes->get('wallet/withdraw', 'WalletController::withdraw');
        $routes->post('wallet/withdraw', 'WalletController::processWithdrawal');
        $routes->get('wallet/withdrawals', 'WalletController::withdrawals');
        $routes->get('wallet/transactions', 'WalletController::transactions');

        // Salary Advance
        $routes->get('advance', 'AdvanceController::index');
        $routes->get('advance/request', 'AdvanceController::request');
        $routes->post('advance/request', 'AdvanceController::submitRequest');
        $routes->get('advance/(:num)', 'AdvanceController::view/$1');

        // Payslips
        $routes->get('payslips', 'PayslipController::index');
        $routes->get('payslips/(:num)', 'PayslipController::view/$1');
        $routes->get('payslips/(:num)/download', 'PayslipController::download/$1');
    });
});
