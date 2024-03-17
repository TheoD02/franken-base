<?php

declare(strict_types=1);

namespace Module\Api\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\JsonType;

class CollectionType extends JsonType
{
    public const string NAME = 'collection';

    #[\Override]
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (\is_object($value) === false) {
            throw new \InvalidArgumentException('The value must be an instance of Collection.');
        }

        if ($value instanceof ArrayCollection === false) {
            throw new \InvalidArgumentException('The value must be an instance of Collection.');
        }

        $first = $value->first();

        $of = null;
        if ($first !== false && \is_object($first)) {
            $of = $first::class;
        }

        $data = [
            'fqcn' => $value::class,
            'of' => $of,
        ];

        //        if ($value instanceof RestApiResourceInterface) {
        //            // TODO: Be more precise where to get the identifier (use Interface ?)
        //            $data['identifiers'] = $value->map(static fn (mixed $item): int => $item->getId())->toArray();
        //
        //            return json_encode($data, \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION);
        //        }

        try {
            $data['items'] = $value->toArray();

            return json_encode($data, \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION);
        } catch (\JsonException $jsonException) {
            throw ConversionException::conversionFailedSerialization($value->toArray(), 'json', $jsonException->getMessage(), $jsonException);
        }
    }

    /**
     * @return Collection<int, mixed>
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): Collection
    {
        if ($value === null || $value === '') {
            return new ArrayCollection();
        }

        $content = $value;
        if (\is_resource($value)) {
            $content = stream_get_contents($value);
        }

        $data = json_decode((string) $content, true, 512, \JSON_THROW_ON_ERROR);

        $collectionFqcn = $data['fqcn'];
        //        $ofFqcn = $data['of'];
        /** @var Collection<array-key, mixed> $collection */
        $collection = new $collectionFqcn();

        //        if (! empty($data['identifiers'])) {
        //            foreach ($data['identifiers'] as $identifier) {
        //                $collection->add((new $ofFqcn())->setId($identifier));
        //            }
        //
        //            return $collection;
        //        }

        foreach ($data['items'] ?? [] as $item) {
            $collection->add($item);
        }

        return $collection;
    }

    #[\Override]
    public function getName(): string
    {
        return parent::getName();
    }
}
