<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A permit issued by a government agency.
 *
 * @see https://schema.org/GovernmentPermit
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GovernmentPermit'])]
class GovernmentPermit extends Permit
{
}
