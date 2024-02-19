<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Configuration\RectorConfigBuilder;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;

class BaseRectorConfig
{
    public static function config(): RectorConfigBuilder
    {
        return RectorConfig::configure()
            ->withRootFiles()
            // uncomment to reach your current PHP version
            // ->withPhpSets()
            ->withPhpSets(php83: true)
            ->withRules([
                AddVoidReturnTypeWhereNoReturnRector::class,
            ]);
    }
}