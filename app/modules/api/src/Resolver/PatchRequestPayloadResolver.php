<?php

declare(strict_types=1);

namespace Module\Api\Resolver;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestPayloadValueResolver;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Exception\PartialDenormalizationException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class PatchRequestPayloadResolver implements EventSubscriberInterface
{
    public function __construct(
        private SerializerInterface&DenormalizerInterface $serializer,
        private ?ValidatorInterface $validator = null,
        private ?TranslatorInterface $translator = null,
    ) {
    }

    public function onKernelControllerArguments(ControllerArgumentsEvent $controllerArgumentsEvent): void
    {
        $arguments = $controllerArgumentsEvent->getArguments();

        $requestMethod = $controllerArgumentsEvent->getRequest()->getMethod();
        if ($requestMethod !== 'PATCH') {
            return;
        }

        $requestPayloadValueResolver = new RequestPayloadValueResolver($this->serializer, $this->validator, $this->translator);
        $baseRequestPayloadResolverReflection = new \ReflectionClass($requestPayloadValueResolver);

        foreach ($arguments as $i => $argument) {
            if ($argument instanceof MapQueryString) {
                $payloadMapper = 'mapQueryString';
                $validationFailedCode = $argument->validationFailedStatusCode;
            } elseif ($argument instanceof MapRequestPayload) {
                $payloadMapper = 'mapRequestPayload';
                $validationFailedCode = $argument->validationFailedStatusCode;
            } else {
                continue;
            }

            $payloadMapperMethod = $baseRequestPayloadResolverReflection->getMethod($payloadMapper);

            $request = $controllerArgumentsEvent->getRequest();

            /** @var class-string $type */
            $type = $argument->metadata->getType();
            if (! $type) {
                throw new \LogicException(sprintf(
                    'Could not resolve the "$%s" controller argument: argument should be typed.',
                    $argument->metadata->getName()
                ));
            }

            if ($this->validator instanceof ValidatorInterface) {
                $violations = new ConstraintViolationList();
                try {
                    $payload = $payloadMapperMethod->invoke($requestPayloadValueResolver, $request, $type, $argument);
                } catch (PartialDenormalizationException $e) { /** @phpstan-ignore-line (is thrown by the serializer) */
                    $trans = $this->translator instanceof TranslatorInterface ? $this->translator->trans(...) : static fn ($m, $p): string => strtr($m, $p);
                    foreach ($e->getErrors() as $notNormalizableValueException) {
                        $parameters = [];
                        $template = 'This value was of an unexpected type.';
                        if ($expectedTypes = $notNormalizableValueException->getExpectedTypes()) {
                            $template = 'This value should be of type {{ type }}.';
                            $parameters['{{ type }}'] = implode('|', $expectedTypes);
                        }

                        if ($notNormalizableValueException->canUseMessageForUser()) {
                            $parameters['hint'] = $notNormalizableValueException->getMessage();
                        }

                        $message = $trans($template, $parameters, 'validators');
                        $violations->add(new ConstraintViolation($message, $template, $parameters, null, $notNormalizableValueException->getPath(), null));
                    }

                    $payload = $e->getData();
                }

                if ($payload !== null && \count($violations) === 0) {
                    $reflectionClass = new \ReflectionClass($type);
                    $violations->addAll($this->validator->validate($payload, null, $argument->validationGroups ?? null));

                    foreach ($violations->getIterator() as $index => $violation) {
                        $property = $reflectionClass->getProperty($violation->getPropertyPath());

                        if ($property->isInitialized($payload)) {
                            continue;
                        }

                        $violations->remove($index);
                    }
                }

                if (\count($violations) > 0) {
                    $message = implode(
                        "\n",
                        array_map(
                            static fn (ConstraintViolationInterface $constraintViolation): string|\Stringable => $constraintViolation->getMessage(),
                            iterator_to_array($violations, false)
                        )
                    );
                    throw new HttpException($validationFailedCode, $message, new ValidationFailedException($payload, $violations));
                }
            } else {
                try {
                    $payload = $payloadMapperMethod->invoke($requestPayloadValueResolver, $request, $type, $argument);
                } catch (PartialDenormalizationException $e) { // @phpstan-ignore-line (is thrown by the serializer)
                    throw new HttpException($validationFailedCode, implode("\n", array_map(static fn ($e): string => $e->getMessage(), $e->getErrors())), $e);
                }
            }

            if ($payload === null) {
                $payload = match (true) {
                    $argument->metadata->hasDefaultValue() => $argument->metadata->getDefaultValue(),
                    $argument->metadata->isNullable() => null,
                    default => throw new HttpException($validationFailedCode)
                };
            }

            $arguments[$i] = $payload;
        }

        $controllerArgumentsEvent->setArguments($arguments);
    }

    #[\Override]
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => ['onKernelControllerArguments', 100],
        ];
    }
}
