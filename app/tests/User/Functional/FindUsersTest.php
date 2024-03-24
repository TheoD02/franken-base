<?php

namespace App\Tests\User\Functional;

use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\User\DummyFactory\DummyUserFactory;
use App\User\Application\Query\FindUsersQuery;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
class FindUsersTest extends KernelTestCase
{
    public function testFindUsersWithoutPagination(): void
    {
        /** @var UserRepositoryInterface $userRepository */
        $userRepository = self::getContainer()->get(UserRepositoryInterface::class);

        /** @var QueryBusInterface $queryBus */
        $queryBus = self::getContainer()->get(QueryBusInterface::class);

        $initialUsers = [];
        foreach (range(1, 5) as $i) {
            $user = DummyUserFactory::createUser();
            $userRepository->add($user);
            $initialUsers[] = $user;
        }

        $users = $queryBus->ask(new FindUsersQuery());

        $this->assertCount(\count($initialUsers), $users);
        foreach ($users as $user) {
            $this->assertContains($user, $initialUsers);
        }
    }

    public function testFindUsersWithPagination(): void
    {
        /** @var UserRepositoryInterface $userRepository */
        $userRepository = self::getContainer()->get(UserRepositoryInterface::class);

        /** @var QueryBusInterface $queryBus */
        $queryBus = self::getContainer()->get(QueryBusInterface::class);

        $initialUsers = [];
        foreach (range(1, 5) as $i) {
            $user = DummyUserFactory::createUser();
            $userRepository->add($user);
            $initialUsers[] = $user;
        }

        $users = $queryBus->ask(new FindUsersQuery(1, 2));

        $this->assertCount(2, $users);
        foreach ($users as $user) {
            $this->assertContains($user, $initialUsers);
        }
    }
}
