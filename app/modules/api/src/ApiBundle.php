<?php

declare(strict_types=1);

namespace Module\Api;

use Module\Api\Doctrine\CollectionType;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class ApiBundle extends AbstractBundle
{
    #[\Override]
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    #[\Override]
    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        $containerConfigurator->import(__DIR__ . '/../config/services.yaml');
    }

    #[\Override]
    public function prependExtension(ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        $containerConfigurator->extension('doctrine', [
            'dbal' => [
                'types' => [
                    'collection' => CollectionType::class,
                ],
            ],
        ]);
    }
}
