<?php

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

    public function onKernelControllerArguments(ControllerArgumentsEvent $event): void
    {
        $arguments = $event->getArguments();

        $requestMethod = $event->getRequest()->getMethod();
        if ('PATCH' !== $requestMethod) {
            return;
        }

        $baseRequestPayloadResolver = new RequestPayloadValueResolver(
            $this->serializer,
            $this->validator,
            $this->translator,
        );

        $baseRequestPayloadResolverReflection = new \ReflectionClass($baseRequestPayloadResolver);

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
            $request = $event->getRequest();

            if (!$type = $argument->metadata->getType()) {
                throw new \LogicException(
                    sprintf('Could not resolve the "$%s" controller argument: argument should be typed.', $argument->metadata->getName())
                );
            }

            if ($this->validator) {
                $violations = new ConstraintViolationList();
                try {
                    $payload = $baseRequestPayloadResolverReflection->getMethod($payloadMapper)->invoke($baseRequestPayloadResolver, $request, $type, $argument);
                } catch (PartialDenormalizationException $e) {
                    $trans = $this->translator ? $this->translator->trans(...) : fn ($m, $p) => strtr($m, $p);
                    foreach ($e->getErrors() as $error) {
                        $parameters = [];
                        $template = 'This value was of an unexpected type.';
                        if ($expectedTypes = $error->getExpectedTypes()) {
                            $template = 'This value should be of type {{ type }}.';
                            $parameters['{{ type }}'] = implode('|', $expectedTypes);
                        }
                        if ($error->canUseMessageForUser()) {
                            $parameters['hint'] = $error->getMessage();
                        }
                        $message = $trans($template, $parameters, 'validators');
                        $violations->add(new ConstraintViolation($message, $template, $parameters, null, $error->getPath(), null));
                    }
                    $payload = $e->getData();
                }

                if (null !== $payload && !\count($violations)) {
                    $reflectionClass = new \ReflectionClass($type);
                    $violations->addAll($this->validator->validate($payload, null, $argument->validationGroups ?? null));

                    foreach ($violations as $index => $violation) {
                        $property = $reflectionClass->getProperty($violation->getPropertyPath());

                        if ($property->isInitialized($payload)) {
                            continue;
                        }

                        $violations->remove($index);
                    }
                }

                if (\count($violations)) {
                    throw new HttpException(
                        $validationFailedCode,
                        implode("\n", array_map(static fn ($e) => $e->getMessage(), iterator_to_array($violations))),
                        new ValidationFailedException($payload, $violations)
                    );
                }
            } else {
                try {
                    $payload = $this->$payloadMapper($request, $type, $argument);
                } catch (PartialDenormalizationException $e) {
                    throw new HttpException($validationFailedCode, implode("\n", array_map(static fn ($e) => $e->getMessage(), $e->getErrors())), $e);
                }
            }

            if (null === $payload) {
                $payload = match (true) {
                    $argument->metadata->hasDefaultValue() => $argument->metadata->getDefaultValue(),
                    $argument->metadata->isNullable() => null,
                    default => throw new HttpException($validationFailedCode)
                };
            }

            $arguments[$i] = $payload;
        }

        $event->setArguments($arguments);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => ['onKernelControllerArguments', 100],
        ];
    }
}
