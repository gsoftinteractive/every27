<?php

/**
 * Every27 - Development Router
 * For use with PHP's built-in server
 * Routes all requests through CodeIgniter 4
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Check if file exists directly (assets, images, css, js, etc.)
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    // Let PHP's built-in server handle static files
    return false;
}

// Route everything else through CI4
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/index.php';
