<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rigid connective tissue that comprises up the skeletal structure of the human body.
 *
 * @see https://schema.org/Bone
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Bone'])]
class Bone extends AnatomicalStructure
{
}
