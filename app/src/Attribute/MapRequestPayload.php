<?php

namespace App\Attribute;

use Symfony\Component\Validator\Constraints\GroupSequence;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class MapRequestPayload extends \Symfony\Component\HttpKernel\Attribute\MapRequestPayload
{
    public function __construct(
        string|GroupSequence|array|null $groups = [],
        string $acceptFormat = 'json',
    ) {

        parent::__construct(
            acceptFormat: $acceptFormat,
            serializationContext: ['groups' => $groups],
            validationGroups: $groups,
        );
    }
}