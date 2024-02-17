<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A short band of tough, flexible, fibrous connective tissue that functions to connect multiple bones, cartilages, and structurally support joints.
 *
 * @see https://schema.org/Ligament
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Ligament'])]
class Ligament extends AnatomicalStructure
{
}
