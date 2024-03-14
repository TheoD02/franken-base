<?php

declare(strict_types=1);

namespace Module\ExceptionHandlerBundle\Serializer\Normalizer;

use Module\ExceptionHandlerBundle\Exception\AbstractHttpException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;

class AbstractHttpExceptionNormalizer implements NormalizerInterface, SerializerAwareInterface
{
    use SerializerAwareTrait;

    public const string TYPE = 'type';

    public const string CODE = 'code';

    public function __construct(
        #[Autowire(param: 'kernel.debug')]
        private readonly bool $debug = false,
    ) {
    }

    /**
     * @return array<string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            FlattenException::class => true,
        ];
    }

    /**
     * @param array<mixed> $context
     */
    #[\Override]
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof FlattenException && $context['exception'] instanceof AbstractHttpException;
    }

    /**
     * @param FlattenException $object
     * @param array<mixed>     $context
     *
     * @return array<mixed>
     */
    #[\Override]
    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        /** @var AbstractHttpException $exception */
        $exception = $context['exception'] ?? null;

        $data = [
            'context_code' => $exception->getContextCode()->value,
            'parent_code' => $exception->getParentErrorCode()->value,
            'error_code' => $exception->getFormattedErrorCode(),
            'status' => $exception->getStatusCode(),
        ];

        if ($this->debug) {
            $data += [
                'message' => $exception->getMessage(),
                'debug_message' => $exception->getDescribe(),
                'context' => $exception->getContext(),
                'class' => $object->getClass(),
                'trace' => $object->getTrace(),
            ];
        }

        return $data;
    }
}
