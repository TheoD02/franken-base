<?php

namespace App\User\Exception;

use App\Api\AbstractHttpException;

abstract class UserException extends AbstractHttpException
{
    public function getErrorCode(): UserExceptionEnum
    {
        return UserExceptionEnum::GENERIC;
    }
}