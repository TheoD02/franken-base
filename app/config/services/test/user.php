<?php

declare(strict_types=1);

use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Infrastructure\Doctrine\AbstractDoctrineUserRepository;
use App\User\Infrastructure\InMemory\AbstractInMemoryUserRepository;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    // repositories
    $services->set(UserRepositoryInterface::class)
        ->class(AbstractInMemoryUserRepository::class);

    $services->set(AbstractInMemoryUserRepository::class)
        ->public();

    $services->set(AbstractDoctrineUserRepository::class)
        ->public();
};
