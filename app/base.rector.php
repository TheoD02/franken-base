<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Configuration\RectorConfigBuilder;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;

function base_rector_config(): RectorConfigBuilder
{
    return RectorConfig::configure()
        ->withPaths([
            __DIR__ . '/config',
            __DIR__ . '/public',
            __DIR__ . '/src',
        ])
        // uncomment to reach your current PHP version
        // ->withPhpSets()
        ->withRules([
            AddVoidReturnTypeWhereNoReturnRector::class,
        ]);
}
