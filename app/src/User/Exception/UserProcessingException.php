<?php

declare(strict_types=1);

namespace App\User\Exception;

use Symfony\Component\HttpFoundation\Response;

class UserProcessingException extends UserException
{
    #[\Override]
    public function getStatusCode(): int
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    #[\Override]
    public function getErrorCode(): UserExceptionEnum
    {
        return UserExceptionEnum::USER_PROCESSING_ERROR;
    }

    #[\Override]
    public function getErrorMessage(): string
    {
        return 'Cannot process the user';
    }

    #[\Override]
    public function describe(array $context = []): string
    {
        return <<<'TXT'
            When trying to process the user, an error occurred.
            Please check the user data and try again.

            The user need to have a valid email address and located in a country where we operate (France, Germany, Spain, Italy, United Kingdom).
            TXT;
    }
}
