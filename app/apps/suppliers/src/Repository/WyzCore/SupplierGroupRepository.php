<?php

declare(strict_types=1);

namespace App\Suppliers\Repository\WyzCore;

use App\Suppliers\Entity\SupplierGroupEntity;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class SupplierGroupRepository extends EntityRepository
{
    // @codeCoverageIgnoreStart
    public function getEntityClass(): string
    {
        return SupplierGroupEntity::class;
    }
    // @codeCoverageIgnoreEnd

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function findByPublicKey(string $publicKey): ?SupplierGroupEntity
    {
        return $this->createQueryBuilder('sg')
            ->select('sg')
            ->where('sg.publicKey = :publicKey')
            ->setParameter('publicKey', $publicKey)
            ->getQuery()->getSingleResult();
    }
}
