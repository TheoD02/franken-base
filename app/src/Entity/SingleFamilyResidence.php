<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Residence type: Single-family home.
 *
 * @see https://schema.org/SingleFamilyResidence
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SingleFamilyResidence'])]
class SingleFamilyResidence extends House
{
    public function __construct()
    {
        parent::__construct();
    }
}
