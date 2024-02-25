<?php

declare(strict_types=1);

namespace Module\Api\Serializer\Normalizer;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Serializer\Attribute\SerializedPath;
use Symfony\Component\Validator\Exception\ValidationFailedException;

use function Symfony\Component\String\u;

readonly class ValidationFailedExceptionNormalizerHandler
{
    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function normalize(ValidationFailedException $exception): array
    {
        $errors = [];

        foreach ($exception->getViolations() as $violation) {
            $propertyPath = $violation->getPropertyPath();
            try {
                $reflectionProperty = new \ReflectionProperty($violation->getRoot(), $violation->getPropertyPath());
                $serializedName = $this->getSerializedName($reflectionProperty);
                $serializedPath = $this->getSerializedPath($reflectionProperty);

                if ($serializedName && $this->requestStack->getCurrentRequest()->query->has($serializedName)) {
                    $propertyPath = $serializedName;
                }

                if ($serializedPath) {
                    $propertyPath = $serializedPath;
                }
            } catch (\Throwable $e) {
                // Do nothing prevent crash when anything goes wrong
            }

            $errors[] = ViolationNormalizerHelper::createViolation(
                propertyPath: $propertyPath,
                code: $violation->getMessage(),
                value: $violation->getInvalidValue(),
                message: str_replace(
                    array_keys($violation->getParameters()),
                    $violation->getParameters(),
                    $violation->getMessageTemplate()
                ),
            );
        }

        return $errors;
    }

    protected function getSerializedName(\ReflectionProperty $reflectionProperty): ?string
    {
        $serializedNameAttributs = $reflectionProperty->getAttributes(SerializedName::class);

        $serializedName = null;
        if (\count($serializedNameAttributs) > 0) {
            $serializedName = $serializedNameAttributs[0]->newInstance()->getSerializedName();
        }

        return $serializedName;
    }

    private function getSerializedPath(\ReflectionProperty $reflectionProperty): ?string
    {
        $serializedPathAttributs = $reflectionProperty->getAttributes(SerializedPath::class);

        $serializedPath = null;
        if (\count($serializedPathAttributs) > 0) {
            /** @var SerializedPath $serializedPath */
            $serializedPath = $serializedPathAttributs[0]->newInstance();
        }

        $fullyMatched = true;
        $queryElement = null;

        foreach ($serializedPath->getSerializedPath()->getElements() as $element) {
            if ($queryElement === null) {
                $queryElement = $this->requestStack->getCurrentRequest()
                    ->query->all($element)
                ;
                continue;
            }

            if (\array_key_exists($element, $queryElement)) {
                $queryElement = $queryElement[$element];
            } else {
                $fullyMatched = false;
                break;
            }
        }

        if ($fullyMatched) {
            $queryPath = u();
            foreach ($serializedPath->getSerializedPath()->getElements() as $element) {
                if ($queryPath->isEmpty()) {
                    $queryPath = $queryPath->append($element);
                } else {
                    $queryPath = $queryPath->append("[{$element}]");
                }
            }

            return $queryPath->toString();
        }

        return null;
    }
}
