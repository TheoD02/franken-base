<?php

declare(strict_types=1);

namespace Module\Api\Serializer\Normalizer;

use Symfony\Component\Serializer\Exception\PartialDenormalizationException;

class PartialDenormalizationExceptionNormalizerHandler
{
    public static function normalize(PartialDenormalizationException $partialDenormalizationException): array
    {
        $errors = [];

        foreach ($partialDenormalizationException->getErrors() as $notNormalizableValueException) {
            $errors[] = ViolationNormalizerHelper::createViolation(
                propertyPath: $notNormalizableValueException->getPath(),
                code: $notNormalizableValueException->getCode(),
                // TODO: Find a way to get the value from the error, for now we just put 'Unknown value'
                value: 'Unknown value',
                message: $notNormalizableValueException->canUseMessageForUser() ? $notNormalizableValueException->getMessage() : 'An error occurred',
            );
        }

        return $errors;
    }
}
