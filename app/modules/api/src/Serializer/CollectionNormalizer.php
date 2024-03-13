<?php

declare(strict_types=1);

namespace Module\Api\Serializer;

use loophp\collection\Collection;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CollectionNormalizer implements DenormalizerInterface, NormalizerInterface
{
    #[\Override]
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = [])
    {
        if (is_subclass_of($context['value_type']->getClassName(), \BackedEnum::class)) {
            $className = $context['value_type']->getClassName();
            $data = array_map(static fn ($value): \BackedEnum => $className::from($value), $data);
        }

        return Collection::fromIterable($data);
    }

    #[\Override]
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null): bool
    {
        return $type === 'array' || str_ends_with($type, '[]');
    }

    #[\Override]
    public function normalize(mixed $object, ?string $format = null, array $context = []): array|bool|string|int|float|\ArrayObject|null
    {
        if ($object->isEmpty()) {
            return $object;
        }

        $convertBackedEnum = $context['backed_enum_as_value'] ?? false;
        if ($convertBackedEnum) {
            return $object->map(static fn ($value) => $value instanceof \BackedEnum ? $value->value : $value)->all(false);
        }

        return $object->all(false);
    }

    #[\Override]
    public function supportsNormalization(mixed $data, ?string $format = null): bool
    {
        return $data instanceof \loophp\collection\Contract\Collection;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            '*' => false,
        ];
    }
}
