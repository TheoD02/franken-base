<?php

declare(strict_types=1);

namespace Module\Api\Serializer\Normalizer;

use Symfony\Component\Serializer\Exception\PartialDenormalizationException;

class PartialDenormalizationExceptionNormalizerHandler
{
    public static function normalize(PartialDenormalizationException $exception): array
    {
        $errors = [];

        foreach ($exception->getErrors() as $error) {
            $errors[] = ViolationNormalizerHelper::createViolation(
                propertyPath: $error->getPath(),
                code: $error->getCode(),
                // TODO: Find a way to get the value from the error, for now we just put 'Unknown value'
                value: 'Unknown value',
                message: $error->canUseMessageForUser() ? $error->getMessage() : 'An error occurred',
            );
        }

        return $errors;
    }
}
