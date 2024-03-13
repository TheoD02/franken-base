<?php

declare(strict_types=1);

namespace Module\Api\Serializer\Normalizer;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\PartialDenormalizationException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ConstraintNormalizer implements NormalizerInterface, SerializerAwareInterface
{
    use SerializerAwareTrait;

    public const string TITLE = 'title';

    public const string TYPE = 'type';

    public const string STATUS = 'status';

    public const string CODE = 'code';

    public const string VIOLATIONS = 'violations';

    public function __construct(
        private readonly ?ValidationFailedExceptionNormalizerHandler $validationFailedExceptionNormalizerHandler,
        #[Autowire(param: 'kernel.debug')]
        private readonly bool $debug = false,
        private readonly array $defaultContext = [],
    ) {
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            FlattenException::class => true,
        ];
    }

    #[\Override]
    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        if (! $object instanceof FlattenException) {
            throw new InvalidArgumentException(sprintf('The object must implement "%s".', FlattenException::class));
        }

        $data = [];
        $context += $this->defaultContext;
        $debug = $this->debug && ($context['debug'] ?? true);
        $exception = $context['exception'] ?? null;

        if ($exception instanceof HttpExceptionInterface) {
            $exception = $exception->getPrevious();

            if ($exception instanceof PartialDenormalizationException) {
                $data = [
                    'context_code' => 'API_PROCESSING',
                    'parent_code' => 'NORMALIZATION',
                    'error_code' => 'NORMALIZATION_PARTIAL_DENORMALIZATION_ERROR',
                    'status' => $context[self::STATUS] ?? $object->getStatusCode(),
                    'message' => $exception->getMessage() ?: null,
                    self::VIOLATIONS => PartialDenormalizationExceptionNormalizerHandler::normalize($exception),
                ];
            } elseif ($exception instanceof ValidationFailedException) {
                $data = [
                    'context_code' => 'API_PROCESSING',
                    'parent_code' => 'VALIDATION',
                    'error_code' => 'VALIDATION_FAILED',
                    'status' => $context[self::STATUS] ?? $object->getStatusCode(),
                    self::VIOLATIONS => $this->validationFailedExceptionNormalizerHandler->normalize($exception),
                ];
            }
        }

        if ($debug) {
            $data['class'] = $object->getClass();
            $data['trace'] = $object->getTrace();
        }

        return [
            'status' => 'error',
            'error' => $data,
        ];
    }

    #[\Override]
    public function supportsNormalization(mixed $data, ?string $format = null /* , array $context = [] */): bool
    {
        return $data instanceof FlattenException;
    }
}
