<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ClassNotation\FinalInternalClassFixer;

require_once dirname(__DIR__) . '/tools/ecs/BaseECSConfig.php';

return BaseECSConfig::config()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/modules/api/src',
    ])
    ->withSkip([FinalInternalClassFixer::class]);
