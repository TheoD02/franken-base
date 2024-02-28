<?php

declare(strict_types=1);

namespace App\User\Exception;

use Module\ExceptionHandlerBundle\Adapter\ApiExceptionContextCodeInterface;
use Module\ExceptionHandlerBundle\Adapter\ApiExceptionErrorCodeInterface;
use Module\ExceptionHandlerBundle\Adapter\ApiExceptionParentCodeInterface;
use Module\ExceptionHandlerBundle\Enum\ContextErrorCode;
use Module\ExceptionHandlerBundle\Exception\AbstractHttpException;

abstract class UserException extends AbstractHttpException
{
    #[\Override]
    public function getContextCode(): ApiExceptionContextCodeInterface
    {
        return ContextErrorCode::TECHNICAL_ERROR;
    }

    #[\Override]
    public function getParentErrorCode(): ApiExceptionParentCodeInterface
    {
        return UserExceptionEnum::USER_EXCEPTION;
    }

    #[\Override]
    abstract public function getErrorCode(): ApiExceptionErrorCodeInterface;
}
