<?php

namespace App\User\Exception;

class UserNotFound extends UserException
{

    #[\Override] public function getErrorMessage(): string
    {
        return 'User not found';
    }

    #[\Override] public function describe(array $context = []): string
    {
        return 'User not found';
    }

    public function getErrorCode(): UserExceptionEnum
    {
        return UserExceptionEnum::USER_NOT_FOUND;
    }
}