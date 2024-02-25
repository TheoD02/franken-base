<?php

declare(strict_types=1);

namespace Module\Api\Serializer\Normalizer;

class ViolationNormalizerHelper
{
    public static function createViolation(string $propertyPath, string $code, mixed $value, string $message): array
    {
        return [
            'propertyPath' => $propertyPath,
            'code' => $code,
            'value' => $value,
            'message' => $message,
        ];
    }
}
