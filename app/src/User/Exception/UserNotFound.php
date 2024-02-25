<?php

declare(strict_types=1);

namespace App\User\Exception;

use Module\Api\Enum\HttpStatus;

// Anywhere in code
//
// throw new UserNotFound('User was not found because of the wrong email.');

class UserNotFound extends UserException
{
    public function __construct(
        private readonly ?string $customDescription = null,
    ) {
        parent::__construct();
    }

    #[\Override]
    public function getErrorMessage(): string
    {
        return 'User not found';
    }

    #[\Override]
    public function describe(array $context = []): string
    {
        return $this->customDescription ?? 'User was not found by the given criteria.';
    }

    #[\Override]
    public function getErrorCode(): UserExceptionEnum
    {
        return UserExceptionEnum::NOT_FOUND;
    }

    #[\Override]
    public function getHttpStatusCode(): HttpStatus
    {
        return HttpStatus::NOT_FOUND;
    }
}
