<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Sales event.
 *
 * @see https://schema.org/SaleEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SaleEvent'])]
class SaleEvent extends Event
{
}
