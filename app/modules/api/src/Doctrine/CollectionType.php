<?php

declare(strict_types=1);

namespace Module\Api\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
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

        return json_encode($value->all(false), \JSON_THROW_ON_ERROR);
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Collection::fromString($value);
    }

    #[\Override]
    public function getName(): string
    {
        return parent::getName();
    }
}
