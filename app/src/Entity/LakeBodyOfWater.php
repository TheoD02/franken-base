<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A lake (for example, Lake Pontrachain).
 *
 * @see https://schema.org/LakeBodyOfWater
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LakeBodyOfWater'])]
class LakeBodyOfWater extends BodyOfWater
{
}
