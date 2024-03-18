<?php

namespace App\Domain\User\ApiState;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class BookCreateProcessor implements ProcessorInterface
{
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        // Handle the state
    }
}
