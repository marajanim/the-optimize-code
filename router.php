<?php
declare(strict_types=1);

// Clean URL router for PHP's local development server.
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = '/' . ltrim(rawurldecode($path), '/');

$legacyRoutes = [
    '/index.php' => '/',
    '/gallery.php' => '/gallery',
    '/testing.php' => '/testing',
];

if (isset($legacyRoutes[$path])) {
    header('Location: ' . $legacyRoutes[$path], true, 301);
    exit;
}

$assetPath = __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, $path);
if ($path !== '/' && is_file($assetPath)) {
    return false;
}

$routes = [
    '/' => 'index.php',
    '/index' => 'index.php',
    '/gallery' => 'gallery.php',
    '/testing' => 'testing.php',
];

if (isset($routes[$path])) {
    require __DIR__ . DIRECTORY_SEPARATOR . $routes[$path];
    return true;
}

http_response_code(404);
header('Content-Type: text/html; charset=UTF-8');
echo '<!doctype html><html lang="en"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Page not found</title><body><h1>404</h1><p>Page not found.</p><a href="/">Return home</a></body></html>';