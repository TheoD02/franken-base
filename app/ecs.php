<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ClassNotation\FinalInternalClassFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;

require_once dirname(__DIR__) . '/tools/ecs/BaseECSConfig.php';

$moduleDirs = glob(__DIR__ . '/modules/*', GLOB_ONLYDIR);

return BaseECSConfig::config()
    ->withCache(__DIR__ . '/var/ecs')
    ->withRules([
        NoUnusedImportsFixer::class,
    ])
    ->withPaths([
        __DIR__ . '/.castor',
        __DIR__ . '/castor.php',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        ...$moduleDirs,
    ])
    ->withSkip([
        FinalInternalClassFixer::class,
        MethodChainingNewlineFixer::class,
    ]);
