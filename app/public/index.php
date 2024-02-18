<?php

declare(strict_types=1);

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

if (isset($_GET['version'], $_SERVER['DEPLOY_VERSION'])) {
    echo $_SERVER['DEPLOY_VERSION'];
    exit(0);
}

$appId = $_SERVER['APP_ID'] ?? null;

if (null === $appId) {
    throw new \RuntimeException('Application ID is required to run the application.');
}

$tenant = null;
if ($appId === 'wtb') {
    $tenant = $_SERVER['HTTP_X_WZ_TENANT'] ?? null;
} else {
    $url = $_SERVER['REQUEST_URI'];
    $pattern = '/api(\/wtb)?(\/internal)?\/tenants\/(\w+)\//';

    preg_match($pattern, $url, $matches);
    $tenant = end($matches) ?? null;
}

if (null !== $tenant) {
    putenv(sprintf('TENANT=%s', $tenant));
}

if (!isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && isset($_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO'])) {
    $_SERVER['HTTP_X_FORWARDED_PROTO'] = $_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO'];
} else {
    $_SERVER['HTTP_X_FORWARDED_PROTO'] = 'https';
}

if (!isset($_SERVER['HTTP_X_FORWARDED_PORT']) || $_SERVER['HTTP_X_FORWARDED_PORT'] == '80') {
    $_SERVER['HTTP_X_FORWARDED_PORT'] = '443';
}

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool)$context['APP_DEBUG'], $context['APP_ID']);
};
