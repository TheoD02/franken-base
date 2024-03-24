<?php

namespace App\Tests\User\Functional;

use App\Shared\Application\Command\CommandBusInterface;
use App\User\Application\Command\CreateUserCommand;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserPassword;
use App\User\Domain\ValueObject\UserRoles;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
class CreateUserTest extends KernelTestCase
{
    public function testCreateUser(): void
    {
        /** @var UserRepositoryInterface $userRepository */
        $userRepository = self::getContainer()->get(UserRepositoryInterface::class);

        /** @var CommandBusInterface $commandBus */
        $commandBus = self::getContainer()->get(CommandBusInterface::class);

        $this->assertEmpty($userRepository);

        $command = new CreateUserCommand(
            email: new UserEmail('test@email.com'),
            password: new UserPassword('password'),
        );
        $commandBus->dispatch($command);

        $this->assertCount(1, $userRepository);

        /** @var User $user */
        $user = array_values(iterator_to_array($userRepository))[0];

        $this->assertEquals(new UserEmail('test@email.com'), $user->email());
        $this->assertEquals(new UserPassword('password'), $user->password());
        $this->assertEquals(new UserRoles([UserRoles::ROLE_USER]), $user->roles());
    }
}
