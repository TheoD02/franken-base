<?php

declare(strict_types=1);

use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Infrastructure\Doctrine\AbstractDoctrineUserRepository;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\User\\', dirname(__DIR__, 2).'/src/User');

    // repositories
    $services->set(UserRepositoryInterface::class)
        ->class(AbstractDoctrineUserRepository::class);
};
