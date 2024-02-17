<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A volcano, like Fujisan.
 *
 * @see https://schema.org/Volcano
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Volcano'])]
class Volcano extends Landform
{
}
