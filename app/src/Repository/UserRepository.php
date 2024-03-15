<?php

declare(strict_types=1);

namespace App\Repository;

use App\User\Api\UserFilterQueryInterface;
use App\User\Entity\UserEntity;
use App\User\ValueObject\UserCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserEntity>
 *
 * @method UserEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEntity[]    findAll()
 * @method UserEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $managerRegistry
    ) {
        parent::__construct($managerRegistry, UserEntity::class);
    }

    public function findByFilterQuery(?UserFilterQueryInterface $userFilterQuery): UserCollection
    {
        $queryBuilder = $this->createQueryBuilder('u');

        $queryBuilder
            ->select('u')
            ->orderBy('u.id', 'ASC')
        ;

        if ($userFilterQuery instanceof UserFilterQueryInterface && $userFilterQuery->query !== null) {
            $queryBuilder
                ->orWhere('u.email LIKE :query')
                ->setParameter('query', '%' . $userFilterQuery->query . '%')
            ;

            $queryBuilder
                ->orWhere('u.lastName LIKE :query')
                ->setParameter('query', '%' . $userFilterQuery->query . '%')
            ;

            $queryBuilder
                ->orWhere('u.firstName LIKE :query')
                ->setParameter('query', '%' . $userFilterQuery->query . '%')
            ;
        }

        return UserCollection::fromIterable($queryBuilder->getQuery()->getResult());
    }
}
