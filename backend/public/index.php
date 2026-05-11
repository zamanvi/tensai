<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Railway terminates SSL at proxy — force PHP to see HTTPS
$_SERVER['HTTPS'] = 'on';
$_SERVER['SERVER_PORT'] = 443;

// Intercept ALL output and replace http:// app URLs with https://
// This catches Filament asset URLs regardless of what the URL generator returns
$_appUrl = getenv('APP_URL') ?: '';
if ($_appUrl && str_starts_with($_appUrl, 'https://')) {
    $_httpAppUrl = 'http://' . substr($_appUrl, 8);
    ob_start(function ($buffer) use ($_httpAppUrl, $_appUrl) {
        return str_replace($_httpAppUrl, $_appUrl, $buffer);
    });
}
unset($_appUrl, $_httpAppUrl);

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
