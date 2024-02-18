<?php

declare(strict_types=1);

namespace App\Suppliers\Repository\WyzCore;

use App\Suppliers\Entity\SupplierPlatformEntity;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<SupplierPlatformEntity>
 */
class SupplierPlatformRepository extends EntityRepository
{
    // @codeCoverageIgnoreStart
    public function getEntityClass(): string
    {
        return SupplierPlatformEntity::class;
    }
    // @codeCoverageIgnoreEnd
}
