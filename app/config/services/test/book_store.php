<?php

declare(strict_types=1);

use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Infrastructure\Doctrine\AbstractDoctrineBookRepository;
use App\BookStore\Infrastructure\InMemory\AbstractInMemoryBookRepository;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    // repositories
    $services->set(BookRepositoryInterface::class)
        ->class(AbstractInMemoryBookRepository::class);

    $services->set(AbstractInMemoryBookRepository::class)
        ->public();

    $services->set(AbstractDoctrineBookRepository::class)
        ->public();
};
