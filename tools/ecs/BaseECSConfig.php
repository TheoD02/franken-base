<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\Configuration\ECSConfigBuilder;

class BaseECSConfig
{
    public static function config(): ECSConfigBuilder
    {
        $cwd = getcwd();
        return ECSConfig::configure()
            ->withRootFiles()

            // add a single rule
            ->withRules([
                NoUnusedImportsFixer::class,
            ])
            ->withPreparedSets(
                psr12: true,
                //common: true,
                symplify: true,
                arrays: true,
                comments: true,
                docblocks: true,
                spaces: true,
                namespaces: true,
                controlStructures: true,
                phpunit: true,
                strict: true,
                cleanCode: true,
            )
            ->withSpacing(
                indentation: '    ',
                lineEnding: '\n',
            )
            ->withPhpCsFixerSets(
                doctrineAnnotation: true,
                per: true,
                perCS: true,
                perCS10: true,
                perCS10Risky: true,
                perCS20: true,
                perCS20Risky: true,
                perCSRisky: true,
                perRisky: true,
                php83Migration: true,
                phpunit100MigrationRisky: true,
                psr1: true,
                psr2: true,
                psr12: true,
                psr12Risky: true,
                phpCsFixer: true,
                phpCsFixerRisky: true,
                symfony: true,
                symfonyRisky: true,
            );
    }
}