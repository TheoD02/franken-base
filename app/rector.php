<?php

declare(strict_types=1);

use RectorPrefix202402\Symfony\Component\Finder\Finder;

require_once dirname(__DIR__) . '/tools/rector/BaseRectorConfig.php';

return BaseRectorConfig::config()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/modules/*/src',
    ]);
