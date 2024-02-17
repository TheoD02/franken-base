<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An office equipment store.
 *
 * @see https://schema.org/OfficeEquipmentStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OfficeEquipmentStore'])]
class OfficeEquipmentStore extends Store
{
}
