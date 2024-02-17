<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

use function dd;

class ErikRessourceProcessor implements ProcessorInterface
{
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        dd($data, $operation, $uriVariables, $context);
    }
}
