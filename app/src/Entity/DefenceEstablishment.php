<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A defence establishment, such as an army or navy base.
 *
 * @see https://schema.org/DefenceEstablishment
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DefenceEstablishment'])]
class DefenceEstablishment extends GovernmentBuilding
{
}
