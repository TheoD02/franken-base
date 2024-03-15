<?php

declare(strict_types=1);

namespace App\User\Exception;

use Module\Api\Enum\HttpStatusEnum;
use Psr\Log\LogLevel;

// Anywhere in code
//
// throw new UserNotFound('UserEntity was not found because of the wrong email.');

class UserNotFoundException extends AbstractUserException
{
    #[\Override]
    public function getErrorMessage(): string
    {
        return 'UserEntity not found';
    }

    #[\Override]
    protected function describe(): string
    {
        return 'UserEntity was not found by the given criteria.';
    }

    #[\Override]
    public function getErrorCode(): UserExceptionEnum
    {
        return UserExceptionEnum::NOT_FOUND;
    }

    #[\Override]
    public function getHttpStatusCode(): HttpStatusEnum
    {
        return HttpStatusEnum::NOT_FOUND;
    }

    #[\Override]
    public function getLogLevel(): string
    {
        return LogLevel::WARNING;
    }
}
