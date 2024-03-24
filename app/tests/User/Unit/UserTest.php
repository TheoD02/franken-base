<?php

declare(strict_types=1);

namespace App\Tests\User\Unit;

use App\User\Domain\Model\User;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserPassword;
use App\User\Domain\ValueObject\UserRoles;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class UserTest extends TestCase
{
    public function testUser(): void
    {
        $user = new User(email: new UserEmail('test@email.com'), password: new UserPassword('password'), roles: new UserRoles(['ROLE_USER']));

        $this->assertEquals($user->id()->value, $user->getUserIdentifier());
        $this->assertEquals($user->roles()->value, $user->getRoles());
    }
}
