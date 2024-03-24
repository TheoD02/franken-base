<?php

declare(strict_types=1);

namespace App\Tests\User\Integration\Doctrine;

use App\Shared\Infrastructure\Doctrine\DoctrinePaginator;
use App\Tests\User\DummyFactory\DummyUserFactory;
use App\User\Infrastructure\Doctrine\AbstractDoctrineUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * @internal
 */
final class DoctrineUserRepositoryTest extends KernelTestCase
{
    private static EntityManagerInterface $em;

    public static function setUpBeforeClass(): void
    {
        self::bootKernel();

        (new Application(self::$kernel))
            ->find('doctrine:database:create')
            ->run(new ArrayInput([
                '--if-not-exists' => true,
            ]), new NullOutput())
        ;

        (new Application(self::$kernel))
            ->find('doctrine:schema:update')
            ->run(new ArrayInput([
                '--force' => true,
            ]), new NullOutput())
        ;
    }

    protected function setUp(): void
    {
        self::$em = self::getContainer()->get(EntityManagerInterface::class);
        self::$em->getConnection()->executeStatement('TRUNCATE user');
    }

    public function testSave(): void
    {
        /** @var AbstractDoctrineUserRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineUserRepository::class);

        $this->assertEmpty($repository);

        $user = DummyUserFactory::createUser();
        $repository->add($user);
        self::$em->flush();

        $this->assertCount(1, $repository);
    }

    public function testRemove(): void
    {
        /** @var AbstractDoctrineUserRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineUserRepository::class);

        $user = DummyUserFactory::createUser();
        $repository->add($user);
        self::$em->flush();

        $this->assertCount(1, $repository);

        $repository->remove($user);
        self::$em->flush();

        $this->assertEmpty($repository);
    }

    public function testOfId(): void
    {
        /** @var AbstractDoctrineUserRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineUserRepository::class);

        $this->assertEmpty($repository);

        $user = DummyUserFactory::createUser();
        $repository->add($user);
        self::$em->flush();
        self::$em->clear();

        $this->assertEquals($user, $repository->ofId($user->id()));
    }

    public function testWithPagination(): void
    {
        /** @var AbstractDoctrineUserRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineUserRepository::class);
        $this->assertNull($repository->paginator());

        $repository = $repository->withPagination(1, 2);

        $this->assertInstanceOf(DoctrinePaginator::class, $repository->paginator());
    }

    public function testWithoutPagination(): void
    {
        /** @var AbstractDoctrineUserRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineUserRepository::class);
        $repository = $repository->withPagination(1, 2);
        $this->assertNotNull($repository->paginator());

        $repository = $repository->withoutPagination();
        $this->assertNull($repository->paginator());
    }

    public function testIteratorWithoutPagination(): void
    {
        $this->markTestSkipped('This test is not working as expected for now, with failing sometimes');
        /** @var AbstractDoctrineUserRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineUserRepository::class);
        $this->assertNull($repository->paginator());

        $users = [DummyUserFactory::createUser(), DummyUserFactory::createUser(), DummyUserFactory::createUser()];
        foreach ($users as $user) {
            $repository->add($user);
        }

        self::$em->flush();

        $i = 0;
        foreach ($repository as $user) {
            $this->assertSame($users[$i], $user);
            ++$i;
        }
    }

    public function testIteratorWithPagination(): void
    {
        /** @var AbstractDoctrineUserRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineUserRepository::class);
        $this->assertNull($repository->paginator());

        $users = [
            DummyUserFactory::createUser(),
            DummyUserFactory::createUser(email: 'test2@email.com'),
            DummyUserFactory::createUser(email: 'test3@email.com'),
        ];

        foreach ($users as $user) {
            $repository->add($user);
        }

        self::$em->flush();

        $repository = $repository->withPagination(1, 2);

        $i = 0;
        foreach ($repository as $user) {
            $this->assertContains($user, $users);
            ++$i;
        }

        $this->assertSame(2, $i);

        $repository = $repository->withPagination(2, 2);

        $i = 0;
        foreach ($repository as $user) {
            $this->assertContains($user, $users);
            ++$i;
        }

        $this->assertSame(1, $i);
    }

    public function testCount(): void
    {
        /** @var AbstractDoctrineUserRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineUserRepository::class);

        $users = [
            DummyUserFactory::createUser(),
            DummyUserFactory::createUser(email: 'test2@email.com'),
            DummyUserFactory::createUser(email: 'test3@email.com'),
        ];
        foreach ($users as $user) {
            $repository->add($user);
        }

        self::$em->flush();

        $this->assertCount(\count($users), $repository);
        $this->assertCount(2, $repository->withPagination(1, 2));
    }
}
