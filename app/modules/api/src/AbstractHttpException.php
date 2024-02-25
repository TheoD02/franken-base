<?php

declare(strict_types=1);

namespace Module\Api;

use Module\Api\Enum\ApiErrorType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

use function Symfony\Component\String\u;

abstract class AbstractHttpException extends HttpException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: $this->getHttpStatusCode(),
            message: $this->getFormattedMessage(),
        );
    }

    abstract public function getErrorMessage(): string;

    /**
     * A description of the error.
     * When, where, and why it occurred.
     *
     * That is used to help to debug the error.
     */
    abstract public function describe(array $context = []): string;

    public function getErrorCode(): \BackedEnum
    {
        return ApiErrorType::UNKNOWN;
    }

    public function getHttpStatusCode(): int
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    private function getFormattedMessage(): string
    {
        return u($this->getErrorMessage())
            ->ensureEnd('.')
            ->append(' ')
            ->append($this->describe())
            ->trim()
            ->ensureEnd('.')
            ->toString()
        ;
    }
}
