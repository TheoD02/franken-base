<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An online or virtual location for attending events. For example, one may attend an online seminar or educational event. While a virtual location may be used as the location of an event, virtual locations should not be confused with physical locations in the real world.
 *
 * @see https://schema.org/VirtualLocation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VirtualLocation'])]
class VirtualLocation extends Intangible
{
}
