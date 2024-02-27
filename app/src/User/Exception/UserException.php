<?php

declare(strict_types=1);

namespace App\User\Exception;

use Module\Api\Enum\ContextErrorCode;
use Module\Api\Exception\AbstractHttpException;

abstract class UserException extends AbstractHttpException
{
    #[\Override]
    public function getContextCode(): \BackedEnum
    {
        return ContextErrorCode::TECHNICAL_ERROR;
    }

    #[\Override]
    public function getParentErrorCode(): \BackedEnum
    {
        return UserExceptionEnum::USER_EXCEPTION;
    }

    #[\Override]
    abstract public function getErrorCode(): UserExceptionEnum;
}
