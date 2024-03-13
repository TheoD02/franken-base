<?php

declare(strict_types=1);

namespace Module\Api\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\JsonType;
use loophp\collection\Collection;

class CollectionType extends JsonType
{
    public const string NAME = 'collection';

    #[\Override]
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value instanceof Collection === false) {
            throw new \InvalidArgumentException('The value must be an instance of Collection.');
        }

        try {
            return json_encode($value, \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION);
        } catch (\JsonException $jsonException) {
            throw ConversionException::conversionFailedSerialization($value->all(false), 'json', $jsonException->getMessage(), $jsonException);
        }
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return Collection::empty();
        }

        if (\is_resource($value)) {
            $value = stream_get_contents($value);
        }

        try {
            $value = json_decode((string) $value, true, 512, \JSON_THROW_ON_ERROR);
        } catch (\JsonException $jsonException) {
            throw ConversionException::conversionFailed($value, $this->getName(), $jsonException);
        }

        return Collection::fromIterable($value);
    }

    #[\Override]
    public function getName(): string
    {
        return parent::getName();
    }
}
