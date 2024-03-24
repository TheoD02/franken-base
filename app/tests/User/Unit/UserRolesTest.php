<?php

declare(strict_types=1);

namespace App\Tests\User\Unit;

use App\User\Domain\ValueObject\UserRoles;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class UserRolesTest extends TestCase
{
    public function testUserRoles(): void
    {
        $userRoles = new UserRoles(['ROLE_USER']);

        $this->assertTrue($userRoles->has(UserRoles::ROLE_USER));

        $userRoles->add('ROLE_ADMIN');

        $this->assertTrue($userRoles->has('ROLE_ADMIN'));

        $userRoles->remove('ROLE_USER');

        $this->assertFalse($userRoles->has(UserRoles::ROLE_USER));

        $this->assertTrue($userRoles->equals(new UserRoles(['ROLE_ADMIN'])));

        $this->assertFalse($userRoles->equals(new UserRoles(['ROLE_USER'])));

        $this->assertFalse($userRoles->equals(new UserRoles(['ROLE_USER', 'ROLE_ADMIN'])));
    }
}
