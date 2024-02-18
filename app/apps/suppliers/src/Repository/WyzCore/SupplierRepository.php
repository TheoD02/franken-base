<?php

declare(strict_types=1);

namespace App\Suppliers\Repository\WyzCore;

use App\Suppliers\Entity\SupplierEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SupplierEntity>
 */
class SupplierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupplierEntity::class);
    }


    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function findByPublicKey(string $publicKey): ?SupplierEntity
    {
        return $this->createQueryBuilder('s')
            ->select('s')
            ->where('s.publicKey = :publicKey')
            ->setParameter('publicKey', $publicKey)
            ->getQuery()->getSingleResult();
    }

//    /**
//     * @return array{groupName:string,supplierTypeId:int}
//     */
    public function findGroupNames(array $supplierTypeIds): array
    {
        $qb = $this->createQueryBuilder('s')
            ->select('DISTINCT(s.groupName) as groupName')
            ->leftJoin('s.supplierType', 'st')
            ->addSelect('st.id as supplierTypeId')
            ->andWhere('s.groupName IS NOT NULL');

        if (!empty($supplierTypeIds)) {
            $qb->andWhere($qb->expr()->in('st.id', $supplierTypeIds));
        }

        return $qb->getQuery()->getResult();
    }
//
//    /**
//     * @return array<SupplierEntity>
//     *
//     * @throws QueryException
//     */
//    public function findActivesSuppliersByPlatform(int $platformId, SupplierFilterQuery $filter): array
//    {
//        $qb = $this->createQueryBuilder('s')
//            ->join('s.supplierPlatforms', 'sp', 'WITH', 'sp.platformId = :platformId')
//            ->join('s.supplierType', 'st')
//            ->addSelect('sp')
//            ->andWhere('s.active = :active')
//            ->setParameter('active', true)
//            ->setParameter('platformId', $platformId);
//
//        $qb->addCriteria($filter->getCriteria());
//
//        return $qb->getQuery()->getResult();
//    }
//
//    /**
//     * @return array<array{publicKey: string, name: string}>
//     */
//    public function autocomplete(SupplierAutocompleteFilterQuery $query): array
//    {
//        $qb = $this->createQueryBuilder('s')->select(['s.publicKey', 's.name']);
//
//        // Retrieve only wyz suppliers
//        $qb->andWhere('s.active = true')
//            ->join('s.supplierPlatforms', 'sp')
//            ->andWhere('sp.wyzOffer = true')
//            ->distinct();
//
//        if ($query->getQuery() !== null) {
//            $qb->andWhere('s.name LIKE :query')
//                ->setParameter('query', '%' . $query->getQuery() . '%');
//        }
//
//        if (!empty($query->getGroupNames())) {
//            $qb->andWhere($qb->expr()->in('s.groupName', $query->getGroupNames()));
//        }
//
//        return $qb->getQuery()->getResult();
//    }
}
