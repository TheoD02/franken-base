<?php

declare(strict_types=1);

namespace Module\Api\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\JsonType;

class CollectionType extends JsonType
{
    public const string NAME = 'collection';

    #[\Override]
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if ($value instanceof ArrayCollection === false) {
            throw new \InvalidArgumentException('The value must be an instance of Collection.');
        }

        try {
            return json_encode($value->toArray(), \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION);
        } catch (\JsonException $jsonException) {
            throw ConversionException::conversionFailedSerialization($value->toArray(), 'json', $jsonException->getMessage(), $jsonException);
        }
    }

    /**
     * @return ArrayCollection<int, object>
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ArrayCollection
    {
        if ($value === null || $value === '') {
            return new ArrayCollection();
        }

        $content = $value;
        if (\is_resource($value)) {
            $content = stream_get_contents($value);
        }

        try {
            $decoded = json_decode((string) $content, true, 512, \JSON_THROW_ON_ERROR);
        } catch (\JsonException $jsonException) {
            throw ConversionException::conversionFailed($value, $this->getName(), $jsonException);
        }

        return new ArrayCollection($decoded);
    }

    #[\Override]
    public function getName(): string
    {
        return parent::getName();
    }
}
