<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

use Module\Api\Exception\AbstractHttpException;

/**
 * This class permit to define the exception that can be thrown by an endpoint.
 *
 * As AbstractHttpException is the base class for all exceptions that can be thrown by an endpoint, this attribute
 * will only accept exception that extends AbstractHttpException.
 *
 * AbstractHttpException already have a status code, so you don't need to specify it here.
 *
 * @see AbstractHttpException If you want to create a new exception.
 */
#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class ApiException
{
    public function __construct(
        /** @var class-string $exceptionFqcn */
        public readonly string $exceptionFqcn,
    ) {
        if (class_exists($exceptionFqcn) === false) {
            throw new \RuntimeException(sprintf('The exception "%s" does not exist.', $exceptionFqcn));
        }

        if (is_subclass_of($exceptionFqcn, AbstractHttpException::class) === false) {
            throw new \RuntimeException(sprintf(
                'The exception "%s" must extend "%s".',
                $exceptionFqcn,
                AbstractHttpException::class
            ));
        }
    }
}
