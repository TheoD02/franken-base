<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A courthouse.
 *
 * @see https://schema.org/Courthouse
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Courthouse'])]
class Courthouse extends GovernmentBuilding
{
}
