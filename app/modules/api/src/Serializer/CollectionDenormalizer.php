<?php

declare(strict_types=1);

namespace Module\Api\Serializer;

use loophp\collection\Collection;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @method array getSupportedTypes(?string $format)
 */
class CollectionDenormalizer implements DenormalizerInterface
{
    #[\Override]
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = [])
    {
        return Collection::fromIterable($data);
    }

    #[\Override]
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null): bool
    {
        return $type === 'array' || str_ends_with($type, '[]');
    }
}
