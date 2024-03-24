<?php

namespace App\Tests\User\Functional;

use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\User\DummyFactory\DummyUserFactory;
use App\User\Application\Query\FindUserQuery;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
class FindUserTest extends KernelTestCase
{
    public function testFindUser(): void
    {
        /** @var UserRepositoryInterface $userRepository */
        $userRepository = self::getContainer()->get(UserRepositoryInterface::class);

        /** @var QueryBusInterface $queryBus */
        $queryBus = self::getContainer()->get(QueryBusInterface::class);

        $user = DummyUserFactory::createUser();
        $userRepository->add($user);

        $this->assertSame($user, $queryBus->ask(new FindUserQuery($user->id())));
    }
}
