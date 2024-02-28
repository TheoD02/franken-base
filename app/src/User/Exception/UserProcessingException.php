<?php

declare(strict_types=1);

namespace App\User\Exception;

use Module\Api\Enum\HttpStatusEnum;
use Psr\Log\LogLevel;

class UserProcessingException extends UserException
{
    #[\Override]
    public function getHttpStatusCode(): HttpStatusEnum
    {
        return HttpStatusEnum::UNPROCESSABLE_ENTITY;
    }

    #[\Override]
    public function getErrorCode(): UserExceptionEnum
    {
        return UserExceptionEnum::PROCESSING_ERROR;
    }

    #[\Override]
    public function getErrorMessage(): string
    {
        return 'Cannot process the user';
    }

    #[\Override]
    public function describe(): string
    {
        return <<<'TXT'
            When trying to process the user, an error occurred.
            Please check the user data and try again.

            The user need to have a valid email address and located in a country where we operate (France, Germany, Spain, Italy, United Kingdom).
            TXT;
    }

    #[\Override]
    public function getLogLevel(): string
    {
        return LogLevel::WARNING;
    }
}
