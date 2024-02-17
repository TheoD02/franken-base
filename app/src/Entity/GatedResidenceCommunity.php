<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Residence type: Gated community.
 *
 * @see https://schema.org/GatedResidenceCommunity
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GatedResidenceCommunity'])]
class GatedResidenceCommunity extends Residence
{
}
