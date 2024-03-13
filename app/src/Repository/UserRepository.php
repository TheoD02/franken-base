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
        ManagerRegistry $registry
    ) {
        parent::__construct($registry, User::class);
    }

    public function findByFilterQuery(?UserFilterQuery $filterQuery): UserCollection
    {
        $qb = $this->createQueryBuilder('u');

        $qb
            ->select('u')
            ->orderBy('u.id', 'ASC')
        ;

        if ($filterQuery instanceof UserFilterQuery && $filterQuery->query !== null) {
            $qb
                ->orWhere('u.email LIKE :query')
                ->setParameter('query', '%' . $filterQuery->query . '%')
            ;

            $qb
                ->orWhere('u.lastName LIKE :query')
                ->setParameter('query', '%' . $filterQuery->query . '%')
            ;

            $qb
                ->orWhere('u.firstName LIKE :query')
                ->setParameter('query', '%' . $filterQuery->query . '%')
            ;
        }

        return UserCollection::fromIterable($qb->getQuery()->getResult());
    }
}
