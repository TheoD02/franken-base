<?php

declare(strict_types=1);

namespace Module\Api\Serializer\Normalizer;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Serializer\Attribute\SerializedPath;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Contracts\Translation\TranslatorInterface;

use function Symfony\Component\String\u;

readonly class ValidationFailedExceptionNormalizerHandler
{
    public function __construct(
        private RequestStack $requestStack,
        private ?TranslatorInterface $translator = null,
    ) {
    }

    /**
     * @return array<array{propertyPath: string, code: string, value: mixed, message: string}>
     */
    public function normalize(ValidationFailedException $validationFailedException): array
    {
        $trans = $this->translator instanceof TranslatorInterface ? $this->translator->trans(...) : static fn (string $m, array $p): string => strtr($m, $p);
        $errors = [];

        foreach ($validationFailedException->getViolations() as $violation) {
            $propertyPath = $violation->getPropertyPath();
            try {
                $reflectionProperty = new \ReflectionProperty($violation->getRoot(), $violation->getPropertyPath());
                $serializedName = $this->getSerializedName($reflectionProperty);
                $serializedPath = $this->getSerializedPath($reflectionProperty);

                if ($serializedName && $this->requestStack->getCurrentRequest()?->query->has($serializedName)) {
                    $propertyPath = $serializedName;
                }

                if ($serializedPath !== null && $serializedPath !== '' && $serializedPath !== '0') {
                    $propertyPath = $serializedPath;
                }
            } catch (\Throwable) { // @phpstan-ignore-line
                // @ignoreException
                // Do nothing prevent crash when anything goes wrong
            }

            $errors[] = ViolationNormalizerHelper::createViolation(
                propertyPath: $propertyPath,
                code: $trans((string) $violation->getMessage(), $violation->getParameters()),
                value: $violation->getInvalidValue(),
                message: str_replace(array_keys($violation->getParameters()), $violation->getParameters(), $violation->getMessageTemplate()),
            );
        }

        return $errors;
    }

    protected function getSerializedName(\ReflectionProperty $reflectionProperty): ?string
    {
        $serializedNameAttributs = $reflectionProperty->getAttributes(SerializedName::class);
        if ($serializedNameAttributs !== []) {
            return $serializedNameAttributs[0]->newInstance()->getSerializedName();
        }

        return null;
    }

    private function getSerializedPath(\ReflectionProperty $reflectionProperty): ?string
    {
        $serializedPathAttributs = $reflectionProperty->getAttributes(SerializedPath::class);

        $serializedPath = null;
        if ($serializedPathAttributs !== []) {
            /** @var SerializedPath $serializedPath */
            $serializedPath = $serializedPathAttributs[0]->newInstance();
        }

        $fullyMatched = true;
        $queryElement = null;

        foreach ($serializedPath?->getSerializedPath()->getElements() ?? [] as $element) {
            if ($queryElement === null) {
                $queryElement = $this->requestStack->getCurrentRequest()?->query->all($element);
                if ($queryElement === null) {
                    $fullyMatched = false;
                    break;
                }

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
            foreach ($serializedPath?->getSerializedPath()->getElements() ?? [] as $element) {
                $queryPath = $queryPath->isEmpty() ? $queryPath->append($element) : $queryPath->append("[{$element}]");
            }

            return $queryPath->toString();
        }

        return null;
    }
}
