<?php

declare(strict_types=1);

namespace App\Tests\User\DummyFactory;

use App\User\Domain\Model\User;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserPassword;
use App\User\Domain\ValueObject\UserRoles;

final class DummyUserFactory
{
    public static function createUser(string $email = 'test@email.com', string $password = 'password', array $roles = [UserRoles::ROLE_USER]): User
    {
        return new User(email: new UserEmail($email), password: new UserPassword($password), roles: new UserRoles($roles));
    }
}
