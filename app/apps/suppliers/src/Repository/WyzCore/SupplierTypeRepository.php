<?php

declare(strict_types=1);

namespace App\Suppliers\Repository\WyzCore;

use App\Suppliers\Entity\SupplierTypeEntity;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<SupplierTypeEntity>
 */
class SupplierTypeRepository extends EntityRepository
{
    // @codeCoverageIgnoreStart
    public function getEntityClass(): string
    {
        return SupplierTypeEntity::class;
    }
    // @codeCoverageIgnoreEnd
}
