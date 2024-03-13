<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use App\User\Api\UserFilterQuery;
use App\User\UserCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $managerRegistry
    ) {
        parent::__construct($managerRegistry, User::class);
    }

    public function findByFilterQuery(?UserFilterQuery $userFilterQuery): UserCollection
    {
        $queryBuilder = $this->createQueryBuilder('u');

        $queryBuilder
            ->select('u')
            ->orderBy('u.id', 'ASC')
        ;

        if ($userFilterQuery instanceof UserFilterQuery && $userFilterQuery->query !== null) {
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
