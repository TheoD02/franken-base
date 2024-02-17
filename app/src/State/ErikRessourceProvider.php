<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\ErikRessource;

class ErikRessourceProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return [(new ErikRessource())->setId(1)->setEmail('enrike@collection.fr')];
        }

        return (new ErikRessource())->setId(1)->setEmail('enrike@single-item.fr');
    }
}
