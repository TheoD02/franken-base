<?php

declare(strict_types=1);

namespace App\User\Exception;

use Module\Api\Enum\HttpStatus;

// Anywhere in code
//
// throw new UserNotFound('User was not found because of the wrong email.');

class UserNotFound extends UserException
{
    /**
     * @var callable|string|null
     */
    private $customDescription;

    public function __construct(
        null|string|callable $customDescription = null
    ) {
        $this->customDescription = $customDescription;
        parent::__construct();
    }

    #[\Override]
    public function getErrorMessage(): string
    {
        return 'User not found';
    }

    #[\Override]
    public function describe(): string
    {
        if (is_callable($this->customDescription)) {
            return ($this->customDescription)();
        }

        if (is_string($this->customDescription)) {
            return $this->customDescription;
        }

        return 'User was not found by the given criteria.';
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
