<?php

declare(strict_types=1);

namespace Module\Api\Serializer\Normalizer;

use Module\Api\AbstractHttpException;
use Module\Api\Enum\ApiErrorType;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\PartialDenormalizationException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Contracts\Translation\TranslatorInterface;

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
        private readonly ?TranslatorInterface $translator = null,
    ) {
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            FlattenException::class => self::class === self::class,
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
            if ($exception instanceof AbstractHttpException) {
                $data = [
                    self::TYPE => ApiErrorType::BUSINESS_ERROR->value,
                    self::TITLE => $exception->getErrorMessage() ?: null,
                    self::STATUS => $exception->getStatusCode(),
                    self::CODE => $exception->getErrorCode(),
                ];

                if ($debug) {
                    $data['debug_message'] = $exception->describe();
                }
            }

            $exception = $exception->getPrevious();

            if ($exception instanceof PartialDenormalizationException) {
                $data = [
                    self::TYPE => ApiErrorType::NORMALIZATION_ERROR->value,
                    self::TITLE => $exception->getMessage() ?: null,
                    self::VIOLATIONS => PartialDenormalizationExceptionNormalizerHandler::normalize($exception),
                ];
            } elseif ($exception instanceof ValidationFailedException) {
                $trans = $this->translator ? $this->translator->trans(...) : static fn ($m, $p) => strtr($m, $p);
                $data = [
                    self::TYPE => ApiErrorType::VALIDATION_ERROR->value,
                    self::TITLE => 'Validation Failed',
                    self::VIOLATIONS => $this->validationFailedExceptionNormalizerHandler->normalize($exception),
                ];
            }
        }

        $data = [
            self::TYPE => $data[self::TYPE] ?? $context[self::TYPE] ?? 'https://tools.ietf.org/html/rfc2616#section-10',
            self::TITLE => $data[self::TITLE] ?? $context[self::TITLE] ?? 'An error occurred',
            self::STATUS => $context[self::STATUS] ?? $object->getStatusCode(),
        ] + $data;
        if ($debug) {
            $data['class'] = $object->getClass();
            $data['trace'] = $object->getTrace();
        }

        return $data;
    }

    #[\Override]
    public function supportsNormalization(mixed $data, ?string $format = null /* , array $context = [] */): bool
    {
        return $data instanceof FlattenException;
    }
}