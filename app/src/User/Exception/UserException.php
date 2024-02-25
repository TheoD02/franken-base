<?php

declare(strict_types=1);

namespace App\User\Exception;

use Module\Api\AbstractHttpException;

abstract class UserException extends AbstractHttpException
{
    public function getErrorCode(): UserExceptionEnum
    {
        return UserExceptionEnum::GENERIC;
    }
}
