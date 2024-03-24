<?php

namespace App\User\Infrastructure\Doctrine;

use App\Shared\Infrastructure\Doctrine\AbstractDoctrineRepository;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends AbstractDoctrineRepository<User>
 */
class AbstractDoctrineUserRepository extends AbstractDoctrineRepository implements UserRepositoryInterface
{
    private const ENTITY_CLASS = User::class;

    private const ALIAS = 'user';

    public function __construct(
        EntityManagerInterface $em
    ) {
        parent::__construct($em, self::ENTITY_CLASS, self::ALIAS);
    }

    public function add(User $user): void
    {
        $this->em->persist($user);
    }

    public function remove(User $user): void
    {
        $this->em->remove($user);
    }

    public function ofId(UserId $id): ?User
    {
        return $this->em->find(self::ENTITY_CLASS, $id);
    }
}
