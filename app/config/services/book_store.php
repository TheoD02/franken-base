<?php

declare(strict_types=1);

use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Infrastructure\Doctrine\AbstractDoctrineBookRepository;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\BookStore\\', dirname(__DIR__, 2).'/src/BookStore');

    // repositories
    $services->set(BookRepositoryInterface::class)
        ->class(AbstractDoctrineBookRepository::class);
};
