<?php

namespace App\Suppliers\EntityListener;

use App\Suppliers\Entity\SupplierEntity;
use App\Suppliers\Enum\SupplierBehavior;
use App\Suppliers\Enum\SupplierType;
use Exception;

class InjectSupplierBehaviorEntityListener
{
    public function postLoad(SupplierEntity $entity): void
    {
        $platformId = 23; // Need to be dynamic retrieve from the request

        try {
            $isOffer = $entity->getSupplierPlatform($platformId)?->isWyzOffer() ?? false;

            $isOffer = true;
            $behavior = $this->getSupplierBehavior($isOffer, $entity);

            $entity->setSupplierBehavior($behavior);
        } catch (Exception $exception) {
            /* $this->logger->alert(
                 'Invalid supplier behavior. Check the supplier / supplier platform configuration',
                 [
                     'supplierPublicKey' => $entity->getPublicKey(),
                     'supplierPlatform' => $entity->getSupplierPlatform($platformId),
                     'platform' => $platformId,
                     'exception' => $exception->getMessage(),
                 ]
             );*/
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    public function getSupplierBehavior(bool $isWyzOffer, SupplierEntity $supplier): SupplierBehavior
    {
        if (!$isWyzOffer) {
            if ($supplier->getSupplierType()?->getId() === SupplierType::MANUFACTURIER->value) {
                return SupplierBehavior::MANUFACTURER;
            }

            if ($supplier->getSupplierType()?->getId() === SupplierType::DISTRIBUTEUR_PLATEFORME->value) {
                return SupplierBehavior::INTRA_GROUP;
            }

            throw new \RuntimeException('Invalid supplier behavior');
        }

        return SupplierBehavior::ALTERNATIVE_WYZ;
    }
}