<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\ApiPlatform\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\BookStore\Application\Command\AnonymizeBooksCommand;
use App\Shared\Application\Command\CommandBusInterface;

/**
 * @implements ProcessorInterface<AnonymizeBooksCommand, null>
 */
final readonly class AnonymizeBooksProcessor implements ProcessorInterface
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    /**
     * @param AnonymizeBooksCommand $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): null
    {
        $this->commandBus->dispatch($data);

        return null;
    }
}
