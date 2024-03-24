<?php

namespace App\User\Application\Command;

use App\Shared\Application\Command\CommandInterface;
use App\User\Domain\Model\User;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserPassword;
use App\User\Domain\ValueObject\UserRoles;

/**
 * @implements CommandInterface<User>
 */
class CreateUserCommand implements CommandInterface
{
    public function __construct(
        public UserEmail $email,
        public UserPassword $password,
        public ?UserRoles $roles = null,
    ) {
    }
}
