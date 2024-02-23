<?php

namespace App\User\Exception;

use Module\Api\AbstractHttpException;

abstract class UserException extends AbstractHttpException
{
    public function getErrorCode(): UserExceptionEnum
    {
        return UserExceptionEnum::GENERIC;
    }
}