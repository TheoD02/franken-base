<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\Configuration\ECSConfigBuilder;

function base_ecs_config(): ECSConfigBuilder
{
    return ECSConfig::configure()
        ->withPaths([
            __DIR__ . '/config',
            __DIR__ . '/public',
            __DIR__ . '/src',
        ])

        // add a single rule
        ->withRules([
            NoUnusedImportsFixer::class,
        ])

        // add sets - group of rules
        // ->withPreparedSets(
        // arrays: true,
        // namespaces: true,
        // spaces: true,
        // docblocks: true,
        // comments: true,
        // )
        ;
}
