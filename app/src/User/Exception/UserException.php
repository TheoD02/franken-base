<?php

declare(strict_types=1);

namespace App\User\Exception;

use Module\Api\Exception\AbstractHttpException;

abstract class UserException extends AbstractHttpException
{
    #[\Override]
    public function getParentErrorCode(): \BackedEnum
    {
        return UserExceptionEnum::USER_EXCEPTION;
    }

    #[\Override]
    abstract public function getErrorCode(): UserExceptionEnum;
}
