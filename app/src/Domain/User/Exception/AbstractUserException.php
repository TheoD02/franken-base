<?php

declare(strict_types=1);

namespace App\Domain\User\Exception;

use Module\ExceptionHandlerBundle\Adapter\ApiExceptionContextCodeInterface;
use Module\ExceptionHandlerBundle\Adapter\ApiExceptionErrorCodeInterface;
use Module\ExceptionHandlerBundle\Adapter\ApiExceptionParentCodeInterface;
use Module\ExceptionHandlerBundle\Enum\ContextErrorCodeEnum;
use Module\ExceptionHandlerBundle\Exception\AbstractHttpException;

abstract class AbstractUserException extends AbstractHttpException
{
    #[\Override]
    public function getContextCode(): ApiExceptionContextCodeInterface
    {
        return ContextErrorCodeEnum::TECHNICAL_ERROR;
    }

    #[\Override]
    public function getParentErrorCode(): ApiExceptionParentCodeInterface
    {
        return UserExceptionEnum::USER_EXCEPTION;
    }

    #[\Override]
    abstract public function getErrorCode(): ApiExceptionErrorCodeInterface;
}
