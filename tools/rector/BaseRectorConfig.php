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
            ->withPhpSets(php83: true)
            ->withAttributesSets(
                symfony: true,
                doctrine: true,
                gedmo: true,
                phpunit: true,
            )
            ->withRules([
                AddVoidReturnTypeWhereNoReturnRector::class,
            ]);
    }
}